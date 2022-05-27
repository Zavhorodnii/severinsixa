<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>


    <div class="account-center order-page">
        <div class="account__top">
            <div class="account__title">
                Deine Bestellungen
            </div>
        </div>

        <?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>
        <?php
//        var_export($customer_orders);
        foreach ( $customer_orders->orders as $customer_order ) {
            $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $item_count = $order->get_item_count() - $order->get_item_count_refunded();
            $order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
            ?>
                    <div class="orders-item">
                        <div class="orders-item-top">
                            <div class="orders-item-top__left">
                                <div class="orders-item__title">
                                    Bestellung vom <?php $order->get_date_created()->format('d.m.Y') ?>
                                </div>
                                <div class="orders-item__code">
                                    <?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
                                </div>
                            </div>
                            <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="orders-item__details btn btn--line">
                                Details
                            </a>
                        </div>
                        <div class="orders-item-products">
                            <?php
                            foreach ( $order_items as $item_id => $item ) {
                                $product = $item->get_product();
                                $is_visible        = $product && $product->is_visible();
                                $qty          = $item->get_quantity();
                                $refunded_qty = $order->get_qty_refunded_for_item( $item_id );

                                if ( $refunded_qty ) {
                                    $qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
                                } else {
                                    $qty_display = esc_html( $qty );
                                }
                                $order_item_quantity = apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $qty_display ) . '</strong>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                $product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
                                ?>
                                <div class="orders-item-products__item">
                                    <div class="orders-item-products__item--img">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <?php echo $product->get_image(); ?>
                                        </picture>
                                    </div>
                                    <p class="orders-item-products__item--name">
                                        <?php
                                        echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) ) . ' ' . $order_item_quantity;

                                        $model = trim(get_field('product_model', $product->get_id()));
                                        if ( strlen($model) > 1){
                                            echo '<br>' . $model;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="orders-item__deliver">
                            <div class="orders-item__deliver--top">
                                Voraussichtliche Lieferung
                                <p>Mo. 04.04.2022 – Di 05.04.2022</p>
                            </div>
                            <div class="orders-item__deliver--status status-grey">
                                Auf dem Weg
                            </div>
                        </div>
                    </div>
            <?php
        }
        ?>

        <?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
    </div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
