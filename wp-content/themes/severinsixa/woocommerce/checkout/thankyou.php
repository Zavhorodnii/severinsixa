<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<link href="<?php echo get_template_directory_uri() ?>/assets/order-confirmation/order-confirmation.css" rel="stylesheet">

<div class="container">
    <ul class="breadcrumbs-list">
        <li class="breadcrumbs-list__item">
            <a href="<?php echo get_home_url() ?>"><?php echo get_the_title(get_option('page_on_front')); ?></a>
        </li>
        <li class="breadcrumbs-list__item">
            <span>Bestellübersicht</span>
        </li>
    </ul>
</div>

<section class="order">
    <div class="container">

        <?php
        if ($order) :

            do_action('woocommerce_before_thankyou', $order->get_id());
            ?>

            <?php if ($order->has_status('failed')) : ?>
            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                   class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                       class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <h2 class="order__title h3"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>

            <p class="order__message">Wir haben eine E-Mail an <span
                        class="order__message-email"><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                mit den Bestellungsdetails geschickt.</p>
            <div class="order__delivery">
                <div class="order__delivery-info">
                    <p class="order__delivery-title h4">Voraussichtliche Lieferung</p>
                    <p class="order__delivery-date body-m">Mo. 04.04.2022 – Di 05.04.2022</p>
                </div>
                <button class="order__delivery-btn btn btn--black">Bestellung verfolgen</button>
            </div>

            <div class="order__table">
                <div class="order__row">
                    <div class="order__column-left">
                        <p>Bestellnummer</p>
                    </div>
                    <div class="order__column-right">
                        <p><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    </div>
                </div>
                <div class="order__row">
                    <div class="order__column-left">
                        <p>Datum</p>
                    </div>
                    <div class="order__column-right">
                        <p><?php echo $order->get_date_created()->format('d.m.Y') ?></p>
                    </div>
                </div>
                <div class="order__row">
                    <div class="order__column-left">
                        <p>E-Mail Adresse</p>
                    </div>
                    <div class="order__column-right">
                        <p><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    </div>
                </div>
                <div class="order__row">
                    <div class="order__column-left">
                        <p>Gesamt</p>
                    </div>
                    <div class="order__column-right">
                        <p><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    </div>
                </div>
                <div class="order__row">
                    <div class="order__column-left">
                        <p>Zahlungsart</p>
                    </div>
                    <div class="order__column-right">
                        <p><?php echo wp_kses_post($order->get_payment_method_title()); ?></p>
                    </div>
                </div>
                <div class="order__row">
                    <div class="order__column-left">
                        <p>Rechnungsadresse</p>
                    </div>
                    <div class="order__column-right">
                        <p><?php echo $order->get_billing_address_1() . ' ' . $order->get_billing_address_2() ?></p>
                        <p><?php echo $order->get_billing_city() . ' ' . $order->get_billing_postcode() ?></p>
                        <?php
                        $countries = WC()->countries->get_shipping_countries();
                        $selected_country = '';
                        foreach ($countries as $ckey => $cvalue) {
                            if ($ckey == $order->get_billing_country()){
                                $selected_country = $cvalue;
                            }
                        }
                        ?>
                        <p><?php echo $selected_country ?></p>
                    </div>
                </div>
            </div>

            <p class="order__info-title h4">Bestellungsdetails</p>

        <?php endif; ?>

<!--            --><?php //do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
            <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

        <?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

        <?php endif; ?>

        <a href="<?php echo get_home_url() ?>" class="order__btn btn btn--black">Mein Konto</a>

    </div>
</section>