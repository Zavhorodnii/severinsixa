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
$current_user_woospca=wp_get_current_user();
$customer_id=$current_user_woospca->ID;
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
echo filter_var('<form action="' . wc_get_page_permalink( 'myaccount' ) . '?be=1" method="post">The following addresses will be used on the checkout page by default.<br><br>');

foreach ( $get_addresses as $name => $address_title ) {
	$fname = get_user_meta( $current_user_woospca->ID, $name . '_first_name', true );
	$lname = get_user_meta( $current_user_woospca->ID, $name . '_last_name', true );
	$_company = get_user_meta( $current_user_woospca->ID, $name . '_company', true );
	$address_1 = get_user_meta( $current_user_woospca->ID, $name . '_address_1', true ); 
	$address_2 = get_user_meta( $current_user_woospca->ID, $name . '_address_2', true );
	$city = get_user_meta( $current_user_woospca->ID, $name . '_city', true );
	$_state = get_user_meta( $current_user_woospca->ID, $name . '_state', true );
	$postcode = get_user_meta( $current_user_woospca->ID, $name . '_postcode', true );
	$_country = get_user_meta( $current_user_woospca->ID, $name . '_country', true );
	$_phone = get_user_meta( $current_user_woospca->ID, $name . '_phone', true );
	$_email = get_user_meta( $current_user_woospca->ID, $name . '_email', true );

	?>

	<strong>Edit <?php echo filter_var(ucfirst($name)); ?> Fields</strong>
	<p >
		

		First Name<span style="color:red;">*</span>
		<input style="width: 100%;" required="required" type="text" value="<?php echo filter_var($fname); ?>" name="<?php echo filter_var($name); ?>_first_name">
	</p>

	<p>
		Last Name<span style="color:red;">*</span>
		<input style="width: 100%;" required="required" type="text" value="<?php echo filter_var($lname); ?>" name="<?php echo filter_var($name); ?>_last_name">

	</p>
	
	<p>
		Comapny Name
		<input type="text" style="width: 100%;" value="<?php echo filter_var($_company); ?>" name="<?php echo filter_var($name); ?>_company"></p>
		<p>
			Country<span style="color:red;">*</span>

			<select style="width: 100%;" id="woospca_sco" required="required" name="<?php echo filter_var($name); ?>_country"></p>
				<?php
				foreach (WC()->countries->get_countries() as $key => $value) {
					?>
					<option value="<?php echo filter_var($key); ?>" 
						<?php 
						if ($key == $_country) {
							echo filter_var('selected');
						} 
						?>
						><?php echo filter_var($value); ?></option>
						<?php
				}
				?>
				</select></p>


				<p>
					Street Address 1<span style="color:red;">*</span>
					<input type="text" style="width: 100%;" required="required" value="<?php echo filter_var($address_1); ?>" name="<?php echo filter_var($name); ?>_address_1"></p>

					<p>
						Address 2
						<input type="text" style="width: 100%;" value="<?php echo filter_var($address_2); ?>" name="<?php echo filter_var(  $name); ?>_address_2"></p>

						<p>
							Town/City<span style="color:red;">*</span>
							<input type="text" style="width: 100%;" required="required" value="<?php echo filter_var($city); ?>" name="<?php echo filter_var($name); ?>_city"></p>
							<p>Postcode/Zip<span style="color:red;">*</span>
								<input type="text" style="width: 100%;" required="required" value="<?php echo filter_var($postcode); ?>" name="<?php echo filter_var($name); ?>_postcode"></p>
								<p>Phone<span style="color:red;">*</span>
									<input type="text" style="width: 100%;" required="required" value="<?php echo filter_var($_phone); ?>" name="<?php echo filter_var($name); ?>_phone"></p>
									<p>Email Address<span style="color:red;">*</span>
										<input type="email" style="width: 100%;" required="required" value="<?php echo filter_var($_email); ?>" name="<?php echo filter_var($name); ?>_email"></p>
										<br><br>
										<?php
}
?>
									<input type="submit" name="update_all_fields_bs" value="Update">
								</form>
								<script type="text/javascript">
									jQuery('#woospca_sco').select2();
								</script>
