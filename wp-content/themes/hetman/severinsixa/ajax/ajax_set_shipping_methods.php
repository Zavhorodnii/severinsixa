<?php


add_action('wp_ajax_ajax_set_shipping_methods', 'ajax_set_shipping_methods');
add_action('wp_ajax_nopriv_ajax_set_shipping_methods', 'ajax_set_shipping_methods');

function ajax_set_shipping_methods(){
    $status = 'error';
    if(!isset($_POST['shipping_methods'])){
        $result = array(
            'status'    => $status,
        );
        echo json_encode($result);
        die();
    }

    $shipping_methods = $_POST['shipping_methods'];

    WC()->session->set('chosen_shipping_methods', array( $shipping_methods ) );
    $status = 'ok';


    $result = get_cart_info();
    $result['status'] = $status;

    echo json_encode($result);
    die();
}