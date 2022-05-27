<?php


add_action('wp_ajax_ajax_change_product_quantity', 'ajax_change_product_quantity');
add_action('wp_ajax_nopriv_ajax_change_product_quantity', 'ajax_change_product_quantity');

function ajax_change_product_quantity(){
    $status = 'error';
    if(!isset($_POST['product_id'])){
        $result = array(
            'status'    => $status,
        );
        echo json_encode($result);
        die();
    }
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        if($_product->get_id() == $product_id){
            WC()->cart->set_quantity( $cart_item_key, $quantity );
            $status = 'ok';
            break;
        }
    }


    $result = get_cart_info();
    $result['status'] = $status;

    echo json_encode($result);
    die();
}