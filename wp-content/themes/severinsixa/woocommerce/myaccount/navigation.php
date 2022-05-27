<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<?php
$index = 1;
foreach ( wc_get_account_menu_items() as $endpoint => $label ) :

    global $wp;
    $request = get_home_url() . '/' . $wp->request . '/';
//    echo '$request = ' . $request;
    $active = $request == wc_get_account_endpoint_url( $endpoint ) ? 'active' : '';
    ?>
    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="account-nav-item <?php echo $active ?>">
        <svg class="svg">
            <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#account-nav-item-icon<?php echo $index!= 1 ? $index : '' ?>"></use>
        </svg>
        <?php echo esc_html( $label ); ?>
    </a>

<?php
$index++;
endforeach; ?>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
