<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>

<link href="<?php echo get_template_directory_uri() ?>/assets/order-confirmation/order-confirmation.css" rel="stylesheet">

<div class="order__table order__table--order-info">

	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>

    <div class="order__row">
        <div class="order__column-left">
            <p>Zwischensumme Produkte</p>
        </div>
        <div class="order__column-right">
            <p><?php echo $order->get_subtotal() . ' ' . get_woocommerce_currency_symbol(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        </div>
    </div>
    <div class="order__row">
        <div class="order__column-left">
            <p>Versandart</p>
        </div>
        <div class="order__column-right">
            <p><?php echo $order->get_shipping_method() ?></p>
        </div>
    </div>

    <?php
    foreach ($order->get_coupons() as $coupon ){
        ?>
        <div class="order__row">
            <div class="order__column-left">
                <p>Coupon</p>
            </div>
            <div class="order__column-right">
                <p><?php echo $coupon->get_code() . ' ' . $coupon->get_discount( ) . ' ' . get_woocommerce_currency_symbol() ?></p>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="order__row">
        <div class="order__column-left">
            <p>Gesamtsumme</p>
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
            <p>Versandadresse</p>
        </div>
        <div class="order__column-right">
            <p><?php echo $order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2() ?></p>
            <p><?php echo $order->get_billing_city() . ' ' . $order->get_billing_postcode() ?></p>
            <?php
            $countries = WC()->countries->get_shipping_countries();
            $selected_country = '';
            foreach ($countries as $ckey => $cvalue) {
                if ($ckey == $order->get_shipping_country()){
                    $selected_country = $cvalue;
                }
            }
            ?>
            <p><?php echo $selected_country ?></p>
        </div>
    </div>


<!--		<tfoot>-->
<!--			--><?php
//			foreach ( $order->get_order_item_totals() as $key => $total ) {
//				?>
<!--					<tr>-->
<!--						<th scope="row">--><?php //echo esc_html( $total['label'] ); ?><!--</th>-->
<!--						<td>--><?php //echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><!--</td>-->
<!--					</tr>-->
<!--					--><?php
//			}
//			?>
<!--			--><?php //if ( $order->get_customer_note() ) : ?>
<!--				<tr>-->
<!--					<th>--><?php //esc_html_e( 'Note:', 'woocommerce' ); ?><!--</th>-->
<!--					<td>--><?php //echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?><!--</td>-->
<!--				</tr>-->
<!--			--><?php //endif; ?>
<!--		</tfoot>-->

<!--	--><?php //do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

</div>
<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
//	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
