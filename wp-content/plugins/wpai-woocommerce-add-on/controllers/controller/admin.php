<?php
/**
 * Introduce special type for controllers which render pages inside admin area
 *
 * @author Maksym Tsypliakov <maksym.tsypliakov@gmail.com>
 */
abstract class PMWI_Controller_Admin extends PMWI_Controller {
	/**
	 * Admin page base url (request url without all get parameters but `page`)
	 * @var string
	 */
	public $baseUrl;
	/**
	 * Parameters which is left when baseUrl is detected
	 * @var array
	 */
	public $baseUrlParamNames = array('page', 'pagenum', 'order', 'order_by', 'type', 's', 'f');
	/**
	 * Whether controller is rendered inside wordpress page
	 * @var bool
	 */
	public $isInline = false;
	/**
	 * Constructor
	 */
	public function __construct() {
		$remove = array_diff(array_keys($_GET), $this->baseUrlParamNames);
		if ($remove) {
			$this->baseUrl = remove_query_arg($remove);
		} else {
			$this->baseUrl = $_SERVER['REQUEST_URI'];
		}
		parent::__construct();
		
		// add special filter for url fields
        if (version_compare(phpversion(), '7.2'  , "<")){
            $filter = create_function('$str', 'return "http://" == $str || "ftp://" == $str ? "" : $str;');
            // add special filter for url fields
            $this->input->addFilter($filter);
        }
		
		// enqueue required sripts and styles
		global $wp_styles;
		if ( ! is_a($wp_styles, 'WP_Styles'))
			$wp_styles = new WP_Styles();
				
		wp_enqueue_style('pmwi-admin-style', PMWI_ROOT_URL . '/static/css/admin.css', array(), PMWI_VERSION);
		
		if ( version_compare(get_bloginfo('version'), '3.8-RC1') >= 0 ){
			wp_enqueue_style('pmwi-admin-style-wp-3.8', PMWI_ROOT_URL . '/static/css/admin-wp-3.8.css');
		}

		wp_enqueue_script('pmwi-script', PMWI_ROOT_URL . '/static/js/pmwi.js', array('jquery'));		
		wp_enqueue_script('pmwi-admin-script', PMWI_ROOT_URL . '/static/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-resizable', 'jquery-ui-dialog', 'jquery-ui-datepicker', 'jquery-ui-draggable', 'jquery-ui-droppable', 'pmxi-admin-script'), PMWI_VERSION);
		
		global $woocommerce;

		$woocommerce_witepanel_params = array(
			'remove_item_notice' 			=> __("Remove this item? If you have previously reduced this item's stock, or this order was submitted by a customer, will need to manually restore the item's stock.", PMWI_Plugin::TEXT_DOMAIN),
			'remove_attribute'				=> __('Remove this attribute?', PMWI_Plugin::TEXT_DOMAIN),
			'name_label'					=> __('Name', PMWI_Plugin::TEXT_DOMAIN),
			'remove_label'					=> __('Remove', PMWI_Plugin::TEXT_DOMAIN),
			'click_to_toggle'				=> __('Click to toggle', PMWI_Plugin::TEXT_DOMAIN),
			'values_label'					=> __('Value(s)', PMWI_Plugin::TEXT_DOMAIN),
			'text_attribute_tip'			=> __('Enter some text, or some attributes by pipe (|) separating values.', PMWI_Plugin::TEXT_DOMAIN),
			'visible_label'					=> __('Visible on the product page', PMWI_Plugin::TEXT_DOMAIN),
			'used_for_variations_label'		=> __('Used for variations', PMWI_Plugin::TEXT_DOMAIN),
			'new_attribute_prompt'			=> __('Enter a name for the new attribute term:', PMWI_Plugin::TEXT_DOMAIN),
			'calc_totals' 					=> __("Calculate totals based on order items, discount amount, and shipping? Note, you will need to (optionally) calculate tax rows and cart discounts manually.", PMWI_Plugin::TEXT_DOMAIN),
			'calc_line_taxes' 				=> __("Calculate line taxes? This will calculate taxes based on the customers country. If no billing/shipping is set it will use the store base country.", PMWI_Plugin::TEXT_DOMAIN),
			'copy_billing' 					=> __("Copy billing information to shipping information? This will remove any currently entered shipping information.", PMWI_Plugin::TEXT_DOMAIN),
			'load_billing' 					=> __("Load the customer's billing information? This will remove any currently entered billing information.", PMWI_Plugin::TEXT_DOMAIN),
			'load_shipping' 				=> __("Load the customer's shipping information? This will remove any currently entered shipping information.", PMWI_Plugin::TEXT_DOMAIN),
			'featured_label'				=> __('Featured', PMWI_Plugin::TEXT_DOMAIN),
			'tax_or_vat'					=> $woocommerce->countries->tax_or_vat(),
			'prices_include_tax' 			=> get_option('woocommerce_prices_include_tax'),
			'round_at_subtotal'				=> get_option( 'woocommerce_tax_round_at_subtotal' ),
			'meta_name'						=> __('Meta Name', PMWI_Plugin::TEXT_DOMAIN),
			'meta_value'					=> __('Meta Value', PMWI_Plugin::TEXT_DOMAIN),
			'no_customer_selected'			=> __('No customer selected', PMWI_Plugin::TEXT_DOMAIN),
			'tax_label'						=> __('Tax Label:', PMWI_Plugin::TEXT_DOMAIN),
			'compound_label'				=> __('Compound:', PMWI_Plugin::TEXT_DOMAIN),
			'cart_tax_label'				=> __('Cart Tax:', PMWI_Plugin::TEXT_DOMAIN),
			'shipping_tax_label'			=> __('Shipping Tax:', PMWI_Plugin::TEXT_DOMAIN),
			'plugin_url' 					=> $woocommerce->plugin_url(),
			'ajax_url' 						=> admin_url('admin-ajax.php'),
			'add_order_item_nonce' 			=> wp_create_nonce("add-order-item"),
			'add_attribute_nonce' 			=> wp_create_nonce("add-attribute"),
			'calc_totals_nonce' 			=> wp_create_nonce("calc-totals"),
			'get_customer_details_nonce' 	=> wp_create_nonce("get-customer-details"),
			'search_products_nonce' 		=> wp_create_nonce("search-products"),
			'calendar_image'				=> $woocommerce->plugin_url().'/assets/images/calendar.png',
			'post_id'						=> null
		 );

		wp_localize_script( 'woocommerce_writepanel', 'woocommerce_writepanel_params', $woocommerce_witepanel_params );

		wp_enqueue_style('pmwi-woo-style', $woocommerce->plugin_url() . '/assets/css/admin.css');
	}	
	
	/**
	 * @see Controller::render()
	 */
	protected function render($viewPath = NULL)
	{
		// assume template file name depending on calling function
		if (is_null($viewPath)) {
			$trace = debug_backtrace();
			$viewPath = str_replace('_', '/', preg_replace('%^' . preg_quote(PMWI_Plugin::PREFIX, '%') . '%', '', strtolower($trace[1]['class']))) . '/' . $trace[1]['function'];
		}
		
		parent::render($viewPath);
	}
	
}