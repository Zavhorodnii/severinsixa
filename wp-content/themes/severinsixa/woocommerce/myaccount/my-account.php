<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>

<section class="account">
    <div class="container account__wrapper">
        <div class="account-nav">
            <div class="account-nav__wrap">
                <?php do_action( 'woocommerce_account_navigation' ); ?>
            </div>
        </div>
        <div>
        <?php
        /**
         * My Account content.
         *
         * @since 2.6.0
         */
        do_action( 'woocommerce_account_content' );
        ?>
</div>
        <div class="account-right" data-da=".account-nav, 1150, 1">
            <?php
            printf(
            /* translators: 1: user display name 2: logout url */
                __( '<p>Bist du nicht %1$s?</p> <a href="%2$s" class="account-right__btn btn btn--line">Log out</a>', 'woocommerce' ),
                esc_html( $current_user->user_firstname ) . ' ' . esc_html( $current_user->user_lastname ),
                esc_url( wc_logout_url() )
            );
            ?>
        </div>
    </div>
</section>

