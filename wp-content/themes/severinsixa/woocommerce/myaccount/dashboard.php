<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
$current_user2 = wp_get_current_user();
?>

    <div class="account-center">
        <div class="account__top">
            <div class="account__title">
                <?php
                printf(
                /* translators: 1: user display name 2: logout url */
                    wp_kses( __( 'Hello %1$s ', 'woocommerce' ), $allowed_html ),
                    esc_html( $current_user->user_firstname ) . ' ' . esc_html( $current_user->user_lastname )
                );
                ?>
            </div>
            <p class="account__descr">
                In deiner Konto-Übersicht kannst du deine letzten Bestellungen ansehen, deine Liefer-
                und
                Rechnungsadresse verwalten und
                dein Passwort und die Kontodetails bearbeiten.
            </p>
        </div>
    </div>


<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
