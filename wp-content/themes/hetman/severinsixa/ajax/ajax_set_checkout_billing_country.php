<?php


add_action('wp_ajax_ajax_set_checkout_billing_country', 'ajax_set_checkout_billing_country');
add_action('wp_ajax_nopriv_ajax_set_checkout_billing_country', 'ajax_set_checkout_billing_country');

function ajax_set_checkout_billing_country(){
    if(!isset($_POST['state'])){
        $result = array(
            'status'    => 'error',
        );
        echo json_encode($result);
        die();
    }
    $state = $_POST['state'];

    WC()->customer->set_billing_country($state);

    $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
    
    $html[] = '<p class="cart__aside-title">Zahlungsart</p>';

    if ( WC()->cart->needs_payment() ) : 
            if ( ! empty( $available_gateways ) ) {
                foreach ( $available_gateways as $gateway ) {
                    $html[] = '<div class="cart__payment-item "><label class="cart__checkbox checkbox--cirlce">
                        <input class="checkbox__input" id="payment_method_'.  esc_attr( $gateway->id ) .'" type="radio" class="input-radio" name="payment_method" value="'. esc_attr( $gateway->id ) .'" '. checked( $gateway->chosen, true ) .' data-order_button_text="' . esc_attr( $gateway->order_button_text ) .'" />

                        <label class="checkbox__content" for="payment_method_' . esc_attr( $gateway->id ) .'">
                            '. $gateway->get_title() .'
                        </label>
                    </label>
                    <div class="cart__payment-icon">
                        '.  $gateway->get_icon() /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ .'
                    </div>';
                     $html[] = '</div>';
                }
            } else {
                $html[] = '<p class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</p>'; // @codingStandardsIgnoreLine
            }
    endif;

    $result = array(
        'status'    => 'ok',
        'payment'     => implode(' ', $html),
    );
    echo json_encode($result);
    die();
}