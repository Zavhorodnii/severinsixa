<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<link href="<?php echo get_template_directory_uri() ?>/assets/cart/cart.css" rel="stylesheet">


<section class="cart">
<!--    <div class="highlight-bar">-->
<!--        <div class="container">-->
<!--            <p class="highlight-bar__text body-s">-->
<!--                Entdecke unseren WINTER SALE – deine Lieblingsprodukte im Winter : Bis zu 50%-->
<!--            </p>-->
<!--            <button class="highlight-bar__btn"></button>-->
<!--        </div>-->
<!--    </div>-->
    <div class="cart__header">
        <div class="container">
            <div class="cart__header-inner">
                <a href="<?php echo get_home_url() ?>" class="back-page">
                    Weitershoppen
                </a>

                <?php
                $site_logo = get_field('site_logo', 'options');
                if (is_array($site_logo)){
                    ?>
<!--                    <a class="cart__header-logo header__logo" href="--><?php //echo get_home_url() ?><!--">-->
<!--                        <img src="--><?php //echo $site_logo['url'] ?><!--" alt="--><?php //echo $site_logo['alt'] ?><!--">-->
<!--                    </a>-->
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <form class="cart__form" name="checkout" method="post" action="<?php echo esc_url( wc_get_checkout_url() ); ?>"  enctype="multipart/form-data">
        <div class="container">
            <div class="cart__form-inner">
                <div class="cart__content">
                    <div class="cart__info">
                        <h2 class="cart__title h2">Kasse</h2>
                    </div>
                    <?php if ( $checkout->get_checkout_fields() ) : ?>

                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <div class="cart__payment-details" id="customer_details">
                            <p class="cart__payment-title">
                                Rechnungsdetails
                            </p>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>

<!--                            <div class="col-2">-->
<!--                                --><?php //do_action( 'woocommerce_checkout_shipping' ); ?>
<!--                            </div>-->
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                    <?php endif; ?>
                </div>
                <aside class="cart__aside">

                    <?php
                    $coupons = WC()->cart->get_applied_coupons();
                    $show = 'none';
                    if (count($coupons) > 0 ){
                        $show = 'block';
                    }
                    ?>
                    <div class="cart__sum js_add_coupons_item" style="display: <?php echo $show ?>">
                        <p class="cart__aside-title">Coupon</p>
                        <?php
                        foreach ( $coupons as $cart_item_key => $coupon ) {
                            $_coupon = new WC_Coupon($coupon);
//                                var_export($_coupon);
                            $symbol = $_coupon->get_discount_type() == 'percent' ? '%' : get_woocommerce_currency_symbol();
                            $amount = $_coupon->get_amount() . ' ' . $symbol;
                            ?>
                            <div class="cart__sum-item">
                                <p class="cart__sum-title"><?php echo $coupon ?></p>
                                <p class="cart__sum-value"><?php echo $amount ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    ?>

                    <div class="cart__sum">
                        <p class="cart__aside-title">GESAMTBETRAG</p>
                        <div class="cart__sum-item">
                            <p class="cart__sum-title">Subtotal</p>
                            <p class="cart__sum-value body-m js_set_subtotal">
                                <?php wc_cart_totals_subtotal_html(); ?>
                            </p>
                        </div>
                        <div class="cart__sum-item">
                            <p class="cart__sum-title">Versandkosten</p>
                            <?php
                            $shipping = WC()->cart->get_cart_shipping_total();
                            if (intval($shipping) > 0 ){
                                $shipping .= ' ' . get_woocommerce_currency_symbol();
                            }
                            ?>
                            <p class="cart__sum-value js_set_shipping"><?php echo $shipping ?></p>
                        </div>
                        <div class="cart__sum-item">
                            <p class="cart__sum-title">MwSt</p>
                            <p class="cart__sum-value js_set_tax"><?php echo WC()->cart->get_taxes_total( true, true )  . ' ' . get_woocommerce_currency_symbol() ?></p>
                        </div>
                        <div class="cart__sum-item cart__sum-item--total">
                            <p class="cart__sum-title">Total</p>
                            <p class="cart__sum-value body-m-bold js_set_total"><?php echo WC()->cart->get_total() . ' ' . get_woocommerce_currency_symbol() ?></p>
                        </div>
                    </div>
                    <div class="cart__delivery-date">
                        <p class="cart__aside-title">LIEFERDATUM</p>
                        <time datetime="2022-03-18">18.03.2022</time>
                    </div>

                    <div class="cart__order">
                        <p class="cart__aside-title">Bestellung</p>
                        <div class="cart__order-top">
                            <p class="cart__order-amount"><span class="js_update_product_cart"><?php echo WC()->cart->get_cart_contents_count() ?></span> Artikel</p>
                            <p class="cart__order-sum js_set_total"><?php echo WC()->cart->get_total() . ' ' . get_woocommerce_currency_symbol() ?></p>
                        </div>
                        <div class="cart__order-wrapper">
                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                ?>
                                <div class="cart__product">
                                    <picture class="cart__product-img">
                                        <source srcset="" type="image/webp">
                                        <?php echo $thumbnail  ?>
                                    </picture>
                                    <div class="cart__product-info">
                                        <p class="cart__product-name h5"><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ); ?></p>
                                        <div class="cart__product-center">
                                            <?php
                                            $model = trim(get_field('product_model', $product_id));
                                            if ( strlen($model) > 1){
                                                ?>
                                                <p class="cart__product-model"><?php echo $model ?></p>
                                                <?php
                                            }
                                            $description = trim($_product->get_short_description());
                                            if (strlen($description) > 0){
                                                ?>
                                                <p class="cart__product-vendor-code"><?php echo $description ?></p>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>


                    <div class="cart__delivery">
                        <p class="cart__aside-title">Versandart</p>
                        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                            <?php wc_cart_totals_shipping_html(); ?>

                            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                        <?php endif; ?>
                    </div>


                    <div class="cart__payment js_paste_payment">
                        <p class="cart__aside-title">Zahlungsart</p>

                        <?php
                        $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
                        if ( WC()->cart->needs_payment() ) : ?>
                                <?php
                                if ( ! empty( $available_gateways ) ) {
                                    foreach ( $available_gateways as $gateway ) {
                                        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                                    }
                                } else {
                                    echo '<p class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</p>'; // @codingStandardsIgnoreLine
                                }
                                ?>
                        <?php endif; ?>

                    </div>

                    <div class="cart__promocode">
                        <p class="cart__promocode-title">Gutschein oder Promocode</p>
                        <div class="cart__promocode-field js_find_info">
                            <input class="cart__promocode-input input js_get_coupons" type="text" name="promocode"
                                   placeholder="Coupon code einfügen">
                            <button class="cart__promocode-btn js_add_coupons"></button>
                        </div>
                    </div>
                    <?php
                    if ( ! wp_doing_ajax() ) {
                        do_action( 'woocommerce_review_order_before_payment' );
                    }
                    ?>

<!--                    <button class="cart__aside-btn btn btn--black" type="button">Kauf abschliessen</button>-->

                    <?php $order_button_text = 'Kauf abschliessen'; ?>

                    <div class="form-row place-order">
                        <noscript>
                            <?php
                            /* translators: $1 and $2 opening and closing emphasis tags respectively */
                            printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
                            ?>
                            <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
                        </noscript>

<!--                        --><?php //wc_get_template( 'checkout/terms.php' ); ?>

                        <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

                        <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="alt cart__aside-btn btn btn--black" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

                        <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

                        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                    </div>
                    <?php

                    if (!wp_doing_ajax()) {
                        do_action('woocommerce_review_order_after_payment');
                    }
                    ?>
                </aside>
            </div>
        </div>
    </form>
</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
