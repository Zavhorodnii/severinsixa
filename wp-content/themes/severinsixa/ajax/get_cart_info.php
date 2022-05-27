<?php

function get_cart_info(){
    WC()->cart->calculate_totals();
    $shipping = WC()->cart->get_cart_shipping_total();
    if (intval($shipping) > 0 ){
        $shipping .= ' ' . get_woocommerce_currency_symbol();
    }
    $info = [
        'curt_items'    => WC()->cart->get_cart_contents_count(),
        'subtotal'      => WC()->cart->get_cart_subtotal(),
        'shipping'      => $shipping,
        'tax'           => WC()->cart->get_taxes_total( true, true )  . ' ' . get_woocommerce_currency_symbol(),
        'total'         => WC()->cart->get_total(),

    ];
    return $info;
}