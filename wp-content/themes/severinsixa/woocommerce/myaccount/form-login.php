<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<link href="<?php echo get_template_directory_uri() ?>/assets/account/style.css" rel="stylesheet">

<section class="entrance entrance-two">
    <div class="container">

        <div class="entrance-link">
            <a href="#" class="entrance-link__item item-entrance active">
                Anmelden
            </a>
            <a href="#" class="entrance-link__item item-registration ">
                Konto erstellen
            </a>
        </div>
<?php
do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>


<?php endif; ?>

		<form class="woocommerce-form entrance-form entrance-form--entrance entrance-form--active" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-wrap">
				<label class="input-title" for="username"><?php esc_html_e( 'E-Mail-Adresse', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input" placeholder="E-Mail Adresse" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-wrap">
				<label class="input-title" for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required input-title">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text input" type="password" placeholder="Passwort" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="entrance-form__bottom">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme entrance-form__check checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox checkbox__input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <p class="checkbox__content"><?php esc_html_e( 'Login-Daten speichern', 'woocommerce' ); ?></p>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

                    <a class="passwort-btn btn btn--blue" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Passwort vergessen?', 'woocommerce' ); ?></a>
			</div>


            <button type="submit" class="woocommerce-button woocommerce-form-login__submit entrance-form__btn btn btn--black" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>


            <?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

		<form method="post" class="woocommerce-form woocommerce-form-register entrance-form entrance-form--registration " <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

            <div class="input-wrap">
                <p class="input-title">Vorname<span>*</span></p>
                <input class="input" required name="first_name" type="text" placeholder="Vorname">
            </div>
            <div class="input-wrap">
                <p class="input-title">Nachname<span>*</span></p>
                <input class="input" required name="last_name" type="text" placeholder="Nachname">
            </div>
            <div class="input-wrap">
                <p class="input-title">Telefonnummer</p>
                <input class="input" name="phone" type="text" placeholder="Telefonnummer">
            </div>
            <div class="input-wrap">
                <p class="input-title">E-Mail-Adresse<span>*</span></p>
                <input type="email" required class="woocommerce-Input woocommerce-Input--text input input-text" name="email" id="reg_email" autocomplete="email"  placeholder="E-Mail-Adresse" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </div>
            <div class="input-wrap">
                <input class="input" required name="email_confirm" type="email" placeholder="E-Mail-Adresse erneut eingeben">
            </div>
            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                <div class="input-wrap">
                    <p class="input-title">Passwort erstellen<span>*</span></p>
                    <input type="password" required class="woocommerce-Input woocommerce-Input--text input input-text" name="password" id="reg_password" autocomplete="new-password"  placeholder="Passwort" />
                    <p class="input-help-text">
                        Das Passwort muss aus mindestens 6 Zeichen bestehen, davon mindestens ein Großbuchstabe,
                        ein Kleinbuchstabe, eine Zahl
                        und ein Sonderzeichen.
                    </p>
                </div>
                <div class="input-wrap">
                    <input class="input" required type="password" name="password_confirm" placeholder="Passwort neu eingeben">
                </div>

			<?php endif; ?>

            <label class="entrance-form__check checkbox">
                <input class="checkbox__input" name="checkbox_confirm" required type="checkbox">
                <p class="checkbox__content">
                    Ja, ich möchte per E-Mail Newsletter über Trends, Aktionen & Gutscheine informiert
                    werden. Abmeldung jederzeit möglich.
                    (optional)
                </p>
            </label>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button woocommerce-form-register__submit entrance-form__btn btn btn--black" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Konto erstellen', 'woocommerce' ); ?></button>
			</p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

            <p class="entrance-form__bottom-text">
                SEVERIN gibt Ihre persönlichen Informationen nicht weiter und verkauft diese nicht.
            </p>
            <a href="#" class="passwort-btn btn btn--blue">
                Datenschutzerklärung
            </a>



		</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    </div>
</section>