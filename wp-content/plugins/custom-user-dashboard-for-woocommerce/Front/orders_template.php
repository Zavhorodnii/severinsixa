<?php
/**
 * My Orders - Deprecated
 *
 * @deprecated 2.6.0 this template file is no longer used. My Account shortcode uses orders.php.
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;
	
$my_orders_columns = apply_filters(
	'woocommerce_my_account_my_orders_columns',
	array(
		'order-number'  => esc_html__( 'Order', 'woocommerce' ),
		'order-date'    => esc_html__( 'Date', 'woocommerce' ),
		'order-status'  => esc_html__( 'Status', 'woocommerce' ),
		'order-total'   => esc_html__( 'Total', 'woocommerce' ),
		'order-actions' => '&nbsp;',
	)
);

$customer_orders = get_posts(
	apply_filters(
		'woocommerce_my_account_my_orders_query',
		array(
			'numberposts' => '-1',
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_type'   => wc_get_order_types( 'view-orders' ),
			'post_status' => array_keys( wc_get_order_statuses() ),
		)
	)
);

if ( $customer_orders ) {
	?>

	<h2><?php echo filter_var(apply_filters( 'woocommerce_my_account_my_orders_title', esc_html__( 'Recent orders', 'woocommerce' ) )); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
	
	<div style="width: 100%;overflow: scroll;">
	<table class="shop_table shop_table_responsive my_account_orders " id="woospca_datatablesep" style="width: 100% !important;">

		<thead>
			<tr>
				<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr">
						<?php
						if ('order-actions' == $column_name || '&nbsp;' == $column_name) {
							echo esc_html( 'Action' );
						} else {
							echo esc_html( $column_name );
						} 
						?>
					</span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ( $customer_orders as $customer_order ) :
				$order_Woospca      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order_Woospca->get_item_count();
				?>
				<tr class="order">
					<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
						<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order_Woospca ); ?>

								<?php elseif ( 'order-number' === $column_id ) : ?>

									<?php echo filter_var( '#' . $order_Woospca->get_order_number()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>


									<?php elseif ( 'order-date' === $column_id ) : ?>
										<time datetime="<?php echo esc_attr( $order_Woospca->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order_Woospca->get_date_created() ) ); ?></time>

										<?php elseif ( 'order-status' === $column_id ) : ?>
											<?php echo esc_html( wc_get_order_status_name( $order_Woospca->get_status() ) ); ?>

											<?php elseif ( 'order-total' === $column_id ) : ?>
												<?php
												/* translators: 1: formatted order total 2: total order items */
							
								
												echo filter_var($order_Woospca->get_formatted_order_total() . ' for ' . $item_count . ' items');
												?>

								<?php elseif ( 'order-actions' === $column_id ) : ?>
									<?php
									$actionss = wc_get_account_orders_actions( $order_Woospca );

									if ( ! empty( $actionss ) ) {
										foreach ( $actionss as $key => $action1 ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

											echo filter_var('<a value="' . $order_Woospca->get_order_number() . '" href="' . wc_get_page_permalink( 'myaccount' ) . '?i=' . $order_Woospca->get_order_number() . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action1['name'] ) . '</a>');
										}
									}
									?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</div>
	<?php
} else {
	?>
	<div style="width:100%;">
		<div class="woocommerce-notices-wrapper"></div>
		<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
			<a class="woocommerce-Button button" href="<?php echo filter_var(wc_get_page_permalink('shop')); ?>">Browse products</a>
		No order has been made yet.	</div>

	</div>
	<?php
}
?>
<script type="text/javascript">	
	setTimeout(function(){jQuery('#woospca_datatablesep').DataTable();},2000);
	
</script>
