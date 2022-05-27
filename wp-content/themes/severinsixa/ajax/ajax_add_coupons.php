<?php


add_action('wp_ajax_ajax_add_coupons', 'ajax_add_coupons');
add_action('wp_ajax_nopriv_ajax_add_coupons', 'ajax_add_coupons');

function ajax_add_coupons(){
    $status = 'error';
    if(!isset($_POST['coupons'])){
        $result = array(
            'status'    => $status,
        );
        echo json_encode($result);
        die();
    }
    $title = '';
    $status = WC()->cart->apply_coupon( trim($_POST['coupons']) );
    $amount = 0;
    $applied_coupons = WC()->cart->get_applied_coupons();

    foreach ( $applied_coupons as $cart_item_key => $coupon ) {
        $title = $coupon;
        $coupon = new WC_Coupon($coupon);
        $symbol = $coupon->get_discount_type() == 'percent' ? '%' : get_woocommerce_currency_symbol();
        $amount = $coupon->get_amount() . ' ' . $symbol;
    }

    $show = 'none';
    if (count($applied_coupons) > 0 ){
        $show = 'block';
    }

    $result = get_cart_info();
    $result['status'] = $status ? 'ok' : 'error';
    $result['amount'] = $amount;
    $result['title'] = $title;
    $result['show_coupon'] = $show;

    echo json_encode($result);
    die();
}