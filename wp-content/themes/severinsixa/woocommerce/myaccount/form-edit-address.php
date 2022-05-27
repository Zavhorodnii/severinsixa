<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;
?>

<?php
$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>
<div class="account-center">
<div class="account__top">
    <div class="account__title">
        Deine Adresse(n)
    </div>
</div>
<div class="adresses">

    <link href="<?php echo get_template_directory_uri() ?>/assets/cart/cart.css" rel="stylesheet">


    <p class="adresses__descr">
        The following adress will be used on the checkout page by default
    </p>
    <div class="adresses__title">
        <?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?>
    </div>
	<form method="post" class="adresses__form">

			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

            <?php
            $address = v_wc_get_account_formatted_address($address, $load_address);
            foreach ( $address as $key => $field ) {
                v_woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
            }
            ?>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<p>
				<button type="submit" class="adresses__form--btn btn btn--black" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>

	</form>
</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

