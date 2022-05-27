<?php
class FrontClassWoosp_Ca {	
	public function __construct() {		
		add_action('init', array($this, 'woospca_call_account_sortcode'), 999);
		add_action('wp_footer', array($this, 'load_scripts_woospca'), 999);		
	}	
	

	public function load_scripts_woospca() {
		if (is_account_page()) {
			?>
			<script type="text/javascript">
				jQuery('.woospca_vis_hdddn').css('filter','unset');
			
				function readURL_woospca(input) {
					formdata = formnames = [], loadfiles = [];
					if(window.FormData) {
						formdata = new FormData();
					}
					if (input.files && input.files[0]) {
						var file_data = input.files[0];
						
						var woospca_image_src=URL.createObjectURL(input.files[0]);
						
						var nameofimage=input.files[0].name;
						formdata.append('imagePreview', file_data);
						
						jQuery.ajax({
							url: '<?php echo filter_var(admin_url('admin-ajax.php')); ?>'+"?action=woospca_upload_image_tod&id=imagePreview&woospca_image_src="+woospca_image_src+"&nameofimage="+nameofimage,
							cache : false,
							contentType : false,
							processData : false,
							data : formdata, 
							type : 'post',
							success: function(result) {
								jQuery('#imagePreview').attr('src', woospca_image_src );
							}
						});


					}
				}
				jQuery("#imageUpload").change(function() {

					readURL_woospca(this);
				});
				jQuery('.logout_woospca_btn').on('click', function(){

					window.location.assign(jQuery(this).val());
				});
			</script>
			<?php
		}
	}

	
	public function woospca_call_account_sortcode() {		
		wp_enqueue_style( 'alphaa_sndsfont-awesome', plugins_url( 'Assets/font-awesome.css', __FILE__ ), false, '1.0', 'all' );
		if (is_user_logged_in()) {
			add_shortcode('woocommerce_my_account', array($this, 'woospca_create_dashboard_callback'));
			if (isset($_REQUEST['update_all_fields_bs'])) {
				$current_user=wp_get_current_user();

				if (isset($_REQUEST['billing_first_name'])) {
					$name='billing';
					if (isset($_REQUEST[$name . '_first_name'])) {
						update_user_meta( $current_user->ID, $name . '_first_name', sanitize_text_field($_REQUEST[$name . '_first_name'] ));
					}
					if (isset($_REQUEST[$name . '_last_name'])) {
						update_user_meta( $current_user->ID, $name . '_last_name', sanitize_text_field($_REQUEST[$name . '_last_name'] ));
					}
					if (isset($_REQUEST[$name . '_company'])) {
						update_user_meta( $current_user->ID, $name . '_company', sanitize_text_field($_REQUEST[$name . '_company'] ));
					}
					if (isset($_REQUEST[$name . '_address_1'])) {
						update_user_meta( $current_user->ID, $name . '_address_1', sanitize_text_field($_REQUEST[$name . '_address_1'] ));
					}
					if (isset($_REQUEST[$name . '_address_2'])) {
						update_user_meta( $current_user->ID, $name . '_address_2', sanitize_text_field($_REQUEST[$name . '_address_2'] ));
					}
					if (isset($_REQUEST[$name . '_city'])) {
						update_user_meta( $current_user->ID, $name . '_city', sanitize_text_field($_REQUEST[$name . '_city'] ));
					}
					if (isset($_REQUEST[$name . '_postcode'])) {
						update_user_meta( $current_user->ID, $name . '_postcode', sanitize_text_field($_REQUEST[$name . '_postcode'] ));
					}
					if (isset($_REQUEST[$name . '_country'])) {
						update_user_meta( $current_user->ID, $name . '_country', sanitize_text_field($_REQUEST[$name . '_country'] ));
					}
					if (isset($_REQUEST[$name . '_phone'])) {
						update_user_meta( $current_user->ID, $name . '_phone', sanitize_text_field($_REQUEST[$name . '_phone'] ));
					}
					if (isset($_REQUEST[$name . '_email'])) {
						update_user_meta( $current_user->ID, $name . '_email', sanitize_text_field($_REQUEST[$name . '_email'] ));
					}

					
				}
				if (isset($_REQUEST['shipping_first_name'])) {
					$name='shipping';
					if (isset($_REQUEST[$name . '_first_name'])) {
						update_user_meta( $current_user->ID, $name . '_first_name', sanitize_text_field($_REQUEST[$name . '_first_name'] ));
					}
					if (isset($_REQUEST[$name . '_last_name'])) {
						update_user_meta( $current_user->ID, $name . '_last_name', sanitize_text_field($_REQUEST[$name . '_last_name'] ));
					}
					if (isset($_REQUEST[$name . '_company'])) {
						update_user_meta( $current_user->ID, $name . '_company', sanitize_text_field($_REQUEST[$name . '_company'] ));
					}
					if (isset($_REQUEST[$name . '_address_1'])) {
						update_user_meta( $current_user->ID, $name . '_address_1', sanitize_text_field($_REQUEST[$name . '_address_1'] ));
					}
					if (isset($_REQUEST[$name . '_address_2'])) {
						update_user_meta( $current_user->ID, $name . '_address_2', sanitize_text_field($_REQUEST[$name . '_address_2'] ));
					}
					if (isset($_REQUEST[$name . '_city'])) {
						update_user_meta( $current_user->ID, $name . '_city', sanitize_text_field($_REQUEST[$name . '_city'] ));
					}
					if (isset($_REQUEST[$name . '_postcode'])) {
						update_user_meta( $current_user->ID, $name . '_postcode', sanitize_text_field($_REQUEST[$name . '_postcode'] ));
					}
					if (isset($_REQUEST[$name . '_country'])) {
						update_user_meta( $current_user->ID, $name . '_country', sanitize_text_field($_REQUEST[$name . '_country'] ));
					}
					if (isset($_REQUEST[$name . '_phone'])) {
						update_user_meta( $current_user->ID, $name . '_phone', sanitize_text_field($_REQUEST[$name . '_phone'] ));
					}
					if (isset($_REQUEST[$name . '_email'])) {
						update_user_meta( $current_user->ID, $name . '_email', sanitize_text_field($_REQUEST[$name . '_email'] ));
					}
				}
			}
		}
		

	}
	public function woospca_create_dashboard_callback() {
		if (is_account_page()) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script('jquerycdbbmin', 'https://code.jquery.com/jquery-1.12.0.min.js', array('jquery'), '1.0', 'all' );        
			wp_enqueue_script('bootminjswoospca', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array('jquery'), '1.0', 'all' );        
			wp_enqueue_script('datatablesssa12', plugins_url( 'datatables.min.js', __FILE__ ), false, '1.0', 'all');    
			wp_enqueue_style('datatables2ss1', 'https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css', '1.0', 'all');

			wp_enqueue_script( 'select2woospca', plugins_url( 'Assets/select2.min.js', __FILE__ ), false, '1.0', 'all');
			wp_enqueue_style( 'select2woospca', plugins_url( 'Assets/select2.min.css', __FILE__ ), false, '1.0', 'all' );
			wp_enqueue_style( 'font-awesdsome', plugins_url( 'booot.min.css', __FILE__ ), false, '1.0', 'all');
			wp_enqueue_style('datatables21animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', '1.0', 'all');
			wp_enqueue_style('lastfainit', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css', '1.0', 'all');
			
		}
		if ( is_user_logged_in() ) {
			$woospca_save_All_general_settings_db_in=get_option('woospca_save_All_general_settings_db_in');
			$woospca_is_avatar=$woospca_save_All_general_settings_db_in['woospca_is_avatar'];

			$woospca_is_upload_avatar=$woospca_save_All_general_settings_db_in['woospca_is_upload_avatar'];			
			$woospca_is_logout=$woospca_save_All_general_settings_db_in['woospca_is_logout'];			
			$woospca_avatar_radius=$woospca_save_All_general_settings_db_in['woospca_avatar_radius'];
			$woospca_menu_pos=$woospca_save_All_general_settings_db_in['woospca_menu_pos'];
			$woospca_menu_style=$woospca_save_All_general_settings_db_in['woospca_menu_style'];
			$woospca_p_t=$woospca_save_All_general_settings_db_in['woospca_p_t'];
			$woospca_p_r=$woospca_save_All_general_settings_db_in['woospca_p_r'];
			$woospca_p_b=$woospca_save_All_general_settings_db_in['woospca_p_b'];
			$woospca_p_l=$woospca_save_All_general_settings_db_in['woospca_p_l'];

			$woospca_d_bg_c=$woospca_save_All_general_settings_db_in['woospca_d_bd_c'];
			$woospca_d_t_c=$woospca_save_All_general_settings_db_in['woospca_d_t_c'];
			$woospca_d_brdrandcorner_c=$woospca_save_All_general_settings_db_in['woospca_d_brdrandcorner_c'];
			$woospca_a_bg_c=$woospca_save_All_general_settings_db_in['woospca_a_bg_c'];
			$woospca_a_t_c=$woospca_save_All_general_settings_db_in['woospca_a_t_c'];
			$woospca_a_brdrandcorner_c=$woospca_save_All_general_settings_db_in['woospca_a_brdrandcorner_c'];
			$woospca_h_bg_c=$woospca_save_All_general_settings_db_in['woospca_h_bg_c'];
			$woospca_h_t_c=$woospca_save_All_general_settings_db_in['woospca_h_t_c'];
			$woospca_h_brdrandcorner_c=$woospca_save_All_general_settings_db_in['woospca_h_brdrandcorner_c'];

			$woospca_d_bg_c2=$woospca_save_All_general_settings_db_in['woospca_d_bd_c2'];
			$woospca_d_t_c2=$woospca_save_All_general_settings_db_in['woospca_d_t_c2'];
			$woospca_d_brdrandcorner_c2=$woospca_save_All_general_settings_db_in['woospca_d_brdrandcorner_c2'];
			$woospca_a_bg_c2=$woospca_save_All_general_settings_db_in['woospca_a_bg_c2'];
			$woospca_a_t_c2=$woospca_save_All_general_settings_db_in['woospca_a_t_c2'];
			$woospca_a_brdrandcorner_c2=$woospca_save_All_general_settings_db_in['woospca_a_brdrandcorner_c2'];
			$woospca_h_bg_c2=$woospca_save_All_general_settings_db_in['woospca_h_bg_c2'];
			$woospca_h_t_c2=$woospca_save_All_general_settings_db_in['woospca_h_t_c2'];
			$woospca_h_brdrandcorner_c2=$woospca_save_All_general_settings_db_in['woospca_h_brdrandcorner_c2'];
			$woospca_d_brdrandcorner_c2bb=$woospca_save_All_general_settings_db_in['woospca_d_brdrandcorner_c2bb'];
			$woospca_a_brdrandcorner_c2bb=$woospca_save_All_general_settings_db_in['woospca_a_brdrandcorner_c2bb'];
			$woospca_h_brdrandcorner_c2bb=$woospca_save_All_general_settings_db_in['woospca_h_brdrandcorner_c2bb'];
			$woospca_logout_bg_clr=$woospca_save_All_general_settings_db_in['woospca_logout_bg_clr'];
			$woospca_logout_t_clr=$woospca_save_All_general_settings_db_in['woospca_logout_t_clr'];




			$woospca_brdr_rdiis=$woospca_save_All_general_settings_db_in['woospca_brdr_rdiis'];
			
			
			if (isset($_SERVER['HTTP_USER_AGENT'])) {
				$useragent=sanitize_text_field($_SERVER['HTTP_USER_AGENT']);
			}
			if ('woospca_menu_stylea' == $woospca_menu_style ) {
				include 'first_tab_design.php';
			} else {
				include 'shadow_tab_design.php';
			}
			?>
			<style type="text/css">
				.logout_woospca_btn{
					background-color: #<?php echo filter_var($woospca_logout_bg_clr); ?> !important;
					color: #<?php echo filter_var($woospca_logout_t_clr); ?> !important;
				}
			</style>
			<?php
			
		}
	}
}
new FrontClassWoosp_Ca();
