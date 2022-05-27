<?php
$current_user = wp_get_current_user();
$card_data = trim(get_user_meta($current_user->ID, 'credit_card_number', true));

global $wp;
$form = stripos($wp->request, '/edit');

$get_params = '';
if ( isset($_POST['cart_num'] ) ){
    update_user_meta( $current_user->ID, 'credit_card_number', sanitize_text_field( $_POST['cart_num'] ) );
    $card_data = $_POST['cart_num'];
}
if($form){
    ?>
    <div class="account-center">
        <div class="account__top">
            <div class="account__title">
                Deine gespeicherten Zahlungsmethoden
            </div>
        </div>
        <form method="post" class="account-payment">
            <div class="account-payment__title">
                Kreditkarten
            </div>
            <div class="account-payment__icons">
                <div><img src="<?php echo get_template_directory_uri() ?>/img/payment-icon3.svg" alt="payment-icon"></div>
                <div><img src="<?php echo get_template_directory_uri() ?>/img/payment-icon4.svg" alt="payment-icon"></div>
                <div><img src="<?php echo get_template_directory_uri() ?>/img/payment-icon5.svg" alt="payment-icon"></div>
            </div>
            <div class="payment-input-wrap">
                <div class="payment-input">
                    <input class="card" type="text" name="cart_num" value="<?php echo $card_data ?>" placeholder="Kartennummer">
                </div>
            </div>
            <button class="account-payment__btn btn btn--black">
                Zahlungsmethode hinzufügen
            </button>
        </form>
    </div>
    <?php
}
else{
    ?>
    <div class="account-center">
        <div class="account__top">
            <div class="account__title">
                Deine gespeicherten Zahlungsmethoden
            </div>
        </div>
        <div class="account-payment">
            <?php
            if( strlen($card_data) == 0 ){
                ?>
                <div class="status-info status-orange">
                    Du hast noch keine gespeicherte Zahlungsmethoden
                </div>
                <?php
            }
            ?>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'credit-card', 'edit' ) ); ?>" class="account-payment__btn btn btn--black">
                Zahlungsmethode hinzufügen
            </a>
        </div>
    </div>
    <?php
}
?>
