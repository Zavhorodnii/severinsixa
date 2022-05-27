<?php


add_action('wp_ajax_ajax_add_product_to_cart', 'ajax_add_product_to_cart');
add_action('wp_ajax_nopriv_ajax_add_product_to_cart', 'ajax_add_product_to_cart');

function ajax_add_product_to_cart(){
    if(!isset($_POST['product_id'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }
    $product_ids = explode(';', $_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    foreach ($product_ids as $product_id)
        WC_PB()->cart->add_bundle_to_cart($product_id, $quantity);

    $result = array(
        'result'    => 'ok',
        'cart_product_count'     => WC()->cart->get_cart_contents_count(),
//        'total_order'     => WC()->cart->get_subtotal(),
    );
    echo json_encode($result);
    die();
}