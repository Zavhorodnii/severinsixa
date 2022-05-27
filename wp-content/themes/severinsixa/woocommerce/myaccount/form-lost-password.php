<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>

<!--    <link href="--><?php //echo get_template_directory_uri() ?><!--/assets/account/style.css" rel="stylesheet">-->

    <section class="entrance passwort-page">
        <div class="container">
            <h2 class="passwort-page__title title title-center">
                Passwort zurücksetzen
            </h2>
            <form method="post" class="woocommerce-ResetPassword entrance-form">

                <div class="input-wrap">

                    <input class="woocommerce-Input woocommerce-Input--text input-text input"
                           placeholder="<?php esc_html_e('Username or email', 'woocommerce'); ?>" type="text"
                           name="user_login" id="user_login" autocomplete="username"/>
                    <!--        <input class="input" type="text" placeholder="E-Mail-Adresse">-->
                    <p class="input-help-text">
                        <?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?>
                    </p>
                </div>

                <?php do_action('woocommerce_lostpassword_form'); ?>

                <input type="hidden" name="wc_reset_password" value="true"/>
                <button type="submit" class="woocommerce-Button entrance-form__btn btn btn--black"
                        value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>

                <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                   class="passwort-btn btn btn--blue">
                    Zurück zur Anmeldung
                </a>

            </form>

        </div>
    </section>
<?php
do_action('woocommerce_after_lost_password_form');
