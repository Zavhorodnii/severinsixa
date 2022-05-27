<?php


add_action('wp_ajax_ajax_remove_from_cart', 'ajax_remove_from_cart');
add_action('wp_ajax_nopriv_ajax_remove_from_cart', 'ajax_remove_from_cart');

function ajax_remove_from_cart(){
    $status = 'error';
    if(!isset($_POST['product_id'])){
        $result = array(
            'status'    => $status,
        );
        echo json_encode($result);
        die();
    }
    $product_id = intval($_POST['product_id']);

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        if($_product->get_id() == $product_id){
            WC()->cart->remove_cart_item($cart_item_key);
            $status = 'ok';
            break;
        }
    }


    $result = get_cart_info();
    $result['status'] = $status;

    echo json_encode($result);
    die();
}