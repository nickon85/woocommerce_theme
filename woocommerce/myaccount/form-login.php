<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$column_class = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) ? 'col-md-6' : 'col-12';

?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

    <div class="<?php echo $column_class; ?> mb-3">
        <div class="p-3 bg-white h-100">
            <h5 class="section-title"><span><?php esc_html_e( 'Login', 'nickon-start' ); ?></span></h5>
            <form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                    <label class="form-label" for="username"><?php esc_html_e( 'Username or email address', 'nickon-start' ); ?>&nbsp;
                        <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text"><?php esc_html_e( 'Required', 'nickon-start' ); ?></span>
                    </label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username"
                           id="username" autocomplete="username"
                           value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                           required aria-required="true"/><?php // @codingStandardsIgnoreLine ?>
                </div>

                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                    <label class="form-label" for="password"><?php esc_html_e( 'Password', 'nickon-start' ); ?>&nbsp;
                        <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text"><?php esc_html_e( 'Required', 'nickon-start' ); ?></span>
                    </label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password"
                           id="password" autocomplete="current-password" required aria-required="true"/>
                </div>

				<?php do_action( 'woocommerce_login_form' ); ?>

                <div class="form-row mb-3">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme form-check-label">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox form-check-input" name="rememberme"
                               type="checkbox" id="rememberme" value="forever"/>
                        <span><?php esc_html_e( 'Remember me', 'nickon-start' ); ?></span>
                    </label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                </div>

                <button type="submit"
                        class="btn btn-success woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                        name="login"
                        value="<?php esc_attr_e( 'Log in', 'nickon-start' ); ?>"><?php esc_html_e( 'Log in', 'nickon-start' ); ?></button>

                <p class="woocommerce-LostPassword lost_password mt-3">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'nickon-start' ); ?></a>
                </p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

            </form>
        </div>
    </div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    <div class="col-md-6 mb-3">
        <div class="p-3 bg-white h-100">
            <h5 class="section-title"><span><?php esc_html_e( 'Register', 'nickon-start' ); ?></span></h5>
            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

		        <?php do_action( 'woocommerce_register_form_start' ); ?>

		        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                        <label class="form-label" for="reg_username"><?php esc_html_e( 'Username', 'nickon-start' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'nickon-start' ); ?></span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
                    </div>

		        <?php endif; ?>

                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                    <label class="form-label" for="reg_email"><?php esc_html_e( 'Email address', 'nickon-start' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'nickon-start' ); ?></span></label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
                </div>

		        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                        <label class="form-label" for="reg_password"><?php esc_html_e( 'Password', 'nickon-start' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'nickon-start' ); ?></span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
                    </div>

		        <?php else : ?>

                    <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'nickon-start' ); ?></p>

		        <?php endif; ?>

		        <?php do_action( 'woocommerce_register_form' ); ?>

                <div class="woocommerce-form-row form-row">
			        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="btn btn-success woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'nickon-start' ); ?>"><?php esc_html_e( 'Register', 'nickon-start' ); ?></button>
                </div>

		        <?php do_action( 'woocommerce_register_form_end' ); ?>

            </form>
        </div>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<?php do_action( 'woocommerce_after_main_content' ); ?>