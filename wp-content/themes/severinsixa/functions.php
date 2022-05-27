<?php

require_once 'settings/init.php';
require_once 'options/options.php';
require_once 'records/init.php';
//require_once 'taxonomy/taxonomy.php';
//require_once 'rewrite/rewrite.php';
require_once 'create_query_args.php';
require_once 'post_fields/init.php';
require_once 'templates/init.php';

require_once 'ajax/ajax.php';

require_once 'v_woocommerce_form_field.php';
require_once 'v_woocommerce_discount.php';
require_once 'v_wc_get_account_formatted_address.php';

//require_once 'telegram_bot/bot.php';

// on thumbnails for post
add_theme_support('post-thumbnails');
//// on title tag
add_theme_support('title-tag');

add_action('init', 'register_menus');
function register_menus(){
    $locations = array(
        //'example' => __('Example Menu', 'theme'),
//        'header'        => 'Шапка',
    );

    register_nav_menus( $locations );
}

function webp_upload_mimes($existing_mimes){
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');


add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
add_action( 'enqueue_block_editor_assets', 'theme_name_scripts' );
function theme_name_scripts() {
    wp_enqueue_style( 'vendor', get_template_directory_uri() . '/assets/vendor.css' );
    wp_enqueue_style( 'global', get_template_directory_uri() . '/assets/global.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/main.css' );
    wp_enqueue_style( 'popup', get_template_directory_uri() . '/assets/popup.css' );
    wp_enqueue_style( 'header', get_template_directory_uri() . '/assets/header.css' );
    wp_enqueue_style( 'payment', get_template_directory_uri() . '/assets/index/payment-methods/payment-methods.css' );
    wp_enqueue_style( 'rating', get_template_directory_uri() . '/assets/rating.css' );
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/footer.css' );
    wp_enqueue_style( 'v_style', get_template_directory_uri() . '/assets/v_style.css' );
}

function footer_scripts(){
    wp_deregister_script('jquery');

    wp_enqueue_script( 'vendor', get_template_directory_uri() . '/js/vendor.js');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js');
    wp_enqueue_script( 'v_jquery', get_template_directory_uri() . '/js/jquery.min.js');
    wp_enqueue_script( 'v_ajax', get_template_directory_uri() . '/js/v_ajax.js');
}
add_action('get_footer', 'footer_scripts', 50);

function l_gutenberg_wide() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'l_gutenberg_wide' );

add_action( 'admin_init', 'disable_autosave' );
function disable_autosave() {
    wp_deregister_script( 'autosave' );
}

add_action( 'post_updated', 'purge_cache_after_post_updated' );
add_action( 'wp_save_post_revision', 'purge_cache_after_post_updated' );

function purge_cache_after_post_updated() {
    global $wpdb;

    $sql_products = $wpdb->get_results( "DELETE FROM wp_posts WHERE post_type = 'revision'" );
}

purge_cache_after_post_updated();

remove_action( 'post_updated', 'wp_save_post_revision' );
//$post_id = wp_update_post( $arg );
//add_action( 'post_updated', 'wp_save_post_revision' );


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields');

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {

    $fields['billing']['salutation'] = array(
        'type'          => 'select',
        'label_class'   => array( 'none', ),
        'input_class' => array('v_input-small', ),
//        'class'         => array('v_input-small', 'select-block-wrap', ),
//        'label'         => __('Salutation'),
        'required'    => true,
        'options'     => array(
            'Herr' => __('Herr'),
            'Frau' => __('Frau')
        ),
        'default' => 'Herr',
        'priority' => 10,
    );

    $fields['billing']['billing_email'] = array(
        'priority' => 20,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', ),
        'placeholder' => 'E-Mail-Adresse',
        'type' => 'email',
    );
    $fields['billing']['billing_first_name'] = array(
        'priority' => 30,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', 'v_input-small',),
        'placeholder' => 'Vorname',
    );
    $fields['billing']['billing_last_name'] = array(
        'priority' => 40,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', 'v_input-small',),
        'placeholder' => 'Nachname',
    );
    $fields['billing']['billing_address_1'] = array(
        'priority' => 50,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', 'v_input-small',),
        'placeholder' => 'Strasse',
    );
    $fields['billing']['billing_address_2'] = array(
        'priority' => 60,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', 'input--small', 'v_input-small',),
        'placeholder' => 'Nummer',
        'type' => 'number',
    );
    $fields['billing']['billing_city'] = array(
        'priority' => 70,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', 'v_input-small',),
        'placeholder' => 'Ort/Stadt',
    );
    $fields['billing']['billing_postcode'] = array(
        'priority' => 80,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', 'v_input-small',),
        'placeholder' => 'Postleitzahl',
        'type' => 'number',
    );
    $fields['billing']['billing_country'] = array(
        'priority' => 90,
        'label_class'   => array( 'none', ),
        'input_class' => array('select', 'v_input-small', ),
        'type' => 'country',
        'required' => true,
        'autocomplete' => 'country',
    );
    $fields['billing']['billing_phone'] = array(
        'priority' => 90,
        'label_class'   => array( 'none', ),
        'input_class' => array('input', ),
        'placeholder' => 'Telefonnummer',
        'type' => 'tel',
    );
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_company']);

//    echo 'test_11';
    return $fields;
}

add_action( 'woocommerce_new_order', 'action_function_name_7561', 10, 2 );
function action_function_name_7561( $order_id, $order ){
//    $order->add_order_note($_POST['salutation']);
    $order->update_meta_data( 'salutation',$_POST['salutation']);
    $order->save();
}

function myplugin_register_template() {
    $post_type_object = get_post_type_object( 'product' );
    $post_type_object->template = array(
		array( 'acf/product-detail-excellence', array( 'align' => 'full' )),
        array('acf/table-block', array()),
		array('acf/product-comparison-grid')
    );
}
add_action( 'init', 'myplugin_register_template' );



function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['first_name'] ) && empty( $_POST['first_name'] ) ) {
        $validation_errors->add( 'first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['last_name'] ) && empty( $_POST['last_name'] ) ) {
        $validation_errors->add( 'last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['email'] ) && empty( $_POST['email'] ) ) {
        $validation_errors->add( 'email_error', __( '<strong>Error</strong>: Email is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['email_confirm'] ) && empty( $_POST['email_confirm'] ) ) {
        $validation_errors->add( 'email_confirm_error', __( '<strong>Error</strong>: Email confirm is required!.', 'woocommerce' ) );
    }
    if ( $_POST['email'] != $_POST['email_confirm'] ) {
        $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Confirmation email error!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['password'] ) && empty( $_POST['password'] ) ) {
        $validation_errors->add( 'password_error', __( '<strong>Error</strong>: Password is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['password_confirm'] ) && empty( $_POST['password_confirm'] ) ) {
        $validation_errors->add( 'password_confirm_error', __( '<strong>Error</strong>: Password confirm is required!.', 'woocommerce' ) );
    }
    if ( $_POST['password'] != $_POST['password_confirm'] ) {
        $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Confirmation password error!.', 'woocommerce' ) );
    }
    return $validation_errors;
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

function wooc_save_extra_register_fields( $customer_id ) {

    if ( isset( $_POST['first_name'] ) ) {
        //First name field which is by default
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['first_name'] ) );
        update_user_meta( $customer_id, 'shipping_first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( isset( $_POST['last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['last_name'] ) );
        update_user_meta( $customer_id, 'shipping_last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( isset( $_POST['phone'] ) ) {
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['phone'] ) );
        update_user_meta( $customer_id, 'shipping_phone', sanitize_text_field( $_POST['phone'] ) );
    }

}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );

//navigation
add_filter( 'woocommerce_account_menu_items', 'add_my_menu_items', 99, 1 );

function add_my_menu_items( $items ) {
    unset($items['downloads']);
    $my_items = [
        'dashboard'         => $items['dashboard'],
        'orders'            => $items['orders'],
        'edit-address'      => $items['edit-address'],
        'edit-account'      => $items['edit-account'],
        'credit-card'       => 'Zahlungsmethoden',
        'customer-logout'   => $items['customer-logout'],
    ];

    return $my_items;
}

add_action( 'init', 'my_account_new_endpoints' );
function my_account_new_endpoints() {
    add_rewrite_endpoint('credit-card', EP_ROOT | EP_PAGES);
}

add_action( 'woocommerce_account_credit-card_endpoint', 'credit_card_endpoint_content' );
function credit_card_endpoint_content() {
    get_template_part('my-account-credit-card');
}