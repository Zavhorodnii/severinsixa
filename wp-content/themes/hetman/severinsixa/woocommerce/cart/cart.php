<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

//WC()->cart->remove_coupons('v_test_1')

//do_action( 'woocommerce_before_cart' ); ?>

<link href="<?php echo get_template_directory_uri() ?>/assets/cart/cart.css" rel="stylesheet">

<?php


?>


<section class="cart">
<!--    <div class="cart__status">-->
<!--        <div class="container">-->
<!--            <div class="cart__status-inner">-->
<!--                <p class="cart__status-text body-m">-->
<!--                    <span>Der SEPURO Pro HV 7187</span>-->
<!--                    wurde zu deinem Warenkorb hinzugefügt.-->
<!--                </p>-->
<!--                <a class="cart__status-btn btn btn--black" href="#">Weiter shoppen</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <form class="cart__form" action="/">
        <div class="container">
            <div class="cart__form-inner">
                <div class="cart__content">
                    <div class="cart__info">
                        <h2 class="cart__title h2">Warenkorb</h2>
                        <p class="cart__products-value body-m " >
                            (<span class="js_update_product_cart"><?php echo WC()->cart->get_cart_contents_count() ?></span> Artikel)
                        </p>
                    </div>
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

//                        $product = $cart_item['data'];
//                        $product_id = $cart_item['product_id'];
                        $quantity = $cart_item['quantity'];
//                        $price = WC()->cart->get_product_price( $product );
//                        $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
//                        $link = $product->get_permalink( $cart_item );
//                        // Anything related to $product, check $product tutorial
//                        $attributes = $product->get_attributes();
//                        $whatever_attribute = $product->get_attribute( 'whatever' );
//                        $whatever_attribute_tax = $product->get_attribute( 'pa_whatever' );
//                        $product_info = wc_get_product($product_id);

                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
//                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                            $price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            $regular_price = $_product->get_regular_price()
                            ?>
                            <div class="cart__product js_get_product_info " data-product_id="<?php echo $product_id ?>">
                                <picture class="cart__product-img">
                                    <?php echo $thumbnail  ?>
                                </picture>
                                <div class="cart__product-info">
                                    <div class="cart__product-top">
                                        <p class="cart__product-name h5"><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ); ?></p>
                                        <p class="cart__product-price body-m-bold">
                                            <?php
                                            if ($_product->get_price() == $regular_price){
                                                echo $price;
                                            }else{
                                                ?>
                                                <span class="cart__product-new-price"><?php echo $price ?></span>
                                                <span class="cart__product-old-price"><?php echo $regular_price . ' ' . get_woocommerce_currency_symbol() ?></span>
                                                <span class="cart__product-sale h5">-<?php echo add_percentage_to_sale_badge($_product) ?></span>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="cart__product-center">
                                        <?php
                                        $model = trim(get_field('product_model', $product_id));
                                        if ( strlen($model) > 1){
                                            ?>
                                            <p class="cart__product-model"><?php echo $model ?></p>
                                            <?php
                                        }
                                        ?>
                                        <p class="cart__product-vendor-code">Artikelnummer <?php echo $_product->get_sku() ?></p>
                                        <div class="select-block-wrap">
                                            <select class="amount-block js_change_quantity">
                                                <?php
                                                $index = 1;
                                                while ($index < 4){
                                                    ?>
                                                    <option value="" <?php echo $index == $quantity ? 'selected' : '' ?>><?php echo $index ?></option>
                                                    <?php
                                                    $index++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    $cross_sell_ids = $_product->get_cross_sell_ids();
                                    if (count($cross_sell_ids) > 0){
                                        ?>
                                        <div class="cart__bundle">
                                            <?php
                                            foreach ($cross_sell_ids as $cross_sell_id){
                                                $cross_product = wc_get_product($cross_sell_id);
                                                ?>
                                                <div class="cart__bundle-item">
                                                    <picture class="cart__bundle-img">
                                                        <source srcset="" type="image/webp">
                                                        <?php echo $cross_product->get_image() ?>
                                                    </picture>
                                                    <div class="cart__bundle-info">
                                                        <p class="cart__bundle-name h6"><?php echo $cross_product->get_title() ?></p>
                                                        <p class="cart__bundle-amount body-s js_update_cross_quantity"><?php echo $quantity ?> x</p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }

                                    ?>
                                    <button class="cart__product-delete body-s js_remove_from_cart" type="button">
                                        Entfernen
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php do_action( 'woocommerce_cart_contents' ); ?>

                </div>
                <aside class="cart__aside">
                    <div class="cart__delivery">
                        <p class="cart__aside-title">Versandart</p>
                        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                            <?php wc_cart_totals_shipping_html(); ?>

                            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                        <?php endif; ?>
                    </div>

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
                            <p class="cart__sum-value body-m-bold js_set_total"><?php echo WC()->cart->get_total() ?></p>
                        </div>
                    </div>
                    <div class="cart__delivery-date">
                        <p class="cart__aside-title">LIEFERDATUM</p>
                        <time datetime="2022-03-18">18.03.2022</time>
                    </div>
                    <div class="cart__promocode">
                        <p class="cart__promocode-title">Gutschein oder Promocode</p>
                        <div class="cart__promocode-field js_find_info">
                            <input class="cart__promocode-input input js_get_coupons" type="text" name="promocode"
                                   placeholder="Coupon code einfügen">
                            <button class="cart__promocode-btn js_add_coupons"></button>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="cart__aside-btn btn btn--black ">
                        <?php esc_html_e( 'Weiter zur Bezahlung', 'woocommerce' ); ?>
                    </a>
<!--                    <button class="cart__aside-btn btn btn--black" type="button">Weiter zur Bezahlung</button>-->
                </aside>
            </div>
        </div>
    </form>
</section>

