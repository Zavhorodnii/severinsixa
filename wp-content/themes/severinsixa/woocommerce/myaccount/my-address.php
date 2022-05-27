<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>

    <div class="account-center">
    <div class="account__top">
        <div class="account__title">
            Deine Adresse(n)
        </div>
    </div>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
	?>

    <?php
    $current_user = wp_get_current_user();
    $customer = new WC_Customer( $current_user->ID );
    $billing_address_1  = trim( $customer->get_billing_address_1() );
    $shipping_address_1  = $customer->get_shipping_address_1();
?>

    <div class="adresses">
        <p class="adresses__descr">
            The following adress will be used on the checkout page by default
        </p>

        <div class="adresses__title">
            <?php echo esc_html( $address_title ); ?>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit adresses__btn btn btn--line"><?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>

        </div>

        <?php
        if ($name == 'billing'){
            if (strlen($billing_address_1) == 0 ){
                ?>
                <div class="adresses__status status-info status-orange">
                    Du hast noch keine Rechnungsadresse hinzugefügt.
                </div>
                <?php
            }else{
                $countries = WC()->countries->get_shipping_countries();
                $selected_country = '';
                foreach ($countries as $ckey => $cvalue) {
                    if ($ckey == $customer->get_billing_country()) {
                        $selected_country = $cvalue;
                    }
                }
                ?>
                <ul class="adresses__list">
                    <li><?php echo $customer->get_billing_first_name() . ' ' . $customer->get_billing_last_name() ?></li>
                    <li><?php echo $customer->get_billing_address_1() . ' ' . $customer->get_billing_address_2() ?></li>
                    <li><?php echo $customer->get_billing_postcode() . ' ' . $customer->get_billing_city() ?></li>
                    <li><?php echo $selected_country ?></li>
                </ul>
                <?php
            }
        }
        if ($name == 'shipping'){
            if (strlen($shipping_address_1) == 0 ){
                ?>
                <div class="adresses__status status-info status-orange">
                    Du hast noch keine Rechnungsadresse hinzugefügt.
                </div>
                <?php
            }else{
                $countries = WC()->countries->get_shipping_countries();
                $selected_country = '';
                foreach ($countries as $ckey => $cvalue) {
                    if ($ckey == $customer->get_shipping_country()) {
                        $selected_country = $cvalue;
                    }
                }
                ?>
                <ul class="adresses__list">
                    <li><?php echo $customer->get_shipping_first_name() . ' ' . $customer->get_shipping_last_name() ?></li>
                    <li><?php echo $customer->get_shipping_address_1() . ' ' . $customer->get_shipping_address_2() ?></li>
                    <li><?php echo $customer->get_shipping_postcode() . ' ' . $customer->get_shipping_city() ?></li>
                    <li><?php echo $selected_country ?></li>
                </ul>
                <?php
            }
        }
        ?>
    </div>


<?php endforeach; ?>

    </div>

