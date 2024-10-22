<?php

/*
 https://woocommerce.com/document/woocommerce-shortcodes/
 https://developer.woocommerce.com/docs/classic-theme-development-handbook/
 https://developer.wordpress.org/themes/customize-api/
 https://codex.wordpress.org/Post_Thumbnails#Thumbnail_Sizes
 https://wp-kama.ru/function/register_post_type
 https://misha.agency/wordpress/setup_postdata.html
 https://woocommerce.github.io/code-reference/packages/WooCommerce.html
 https://woocommerce.com/document/show-cart-contents-total
 https://woocommerce.com/document/customise-the-woocommerce-breadcrumb/
 https://woocommerce.com/document/woocommerce-display-category-image-on-category-archive/
 https://woocommerce.com/document/woocommerce-shortcodes/product-category/
 https://developer.woocommerce.com/docs/customizing-checkout-fields-using-actions-and-filters/
 https://wp-kama.ru/function/wpdb

	Advanced Woo Search
	Filter Everything — WooCoomerce Product & WordPress Filter
	XT Ajax Add To Cart for WooCommerce
	Yoast Duplicate Post
	WooPayments
	Show Current Template
	Font Awesome

 wp-content/languages/woocommerce
*/

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'nickon-start', get_template_directory() . '/languages' );

	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

//	add_theme_support( 'wc-product-gallery-zoom' );
//	add_theme_support( 'wc-product-gallery-lightbox' );
//	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( [
		'header-menu' => __( 'Header menu', 'nickon-start' ),
		'footer-menu' => __( 'Footer menu', 'nickon-start' ),
	] );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'nickonstart-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap' );
	wp_enqueue_style( 'nickonstart-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'nickonstart-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' );
	wp_enqueue_style( 'nickonstart-owl-carousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.css' );
	wp_enqueue_style( 'nickonstart-owl-carousel-theme', get_template_directory_uri() . '/assets/owlcarousel/owl.theme.default.min.css' );
	wp_enqueue_style( 'nickonstart-fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css' );
	/*wp_enqueue_style( 'nickonstart-carousel', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css' );
	wp_enqueue_style( 'nickonstart-carousel-thumbs', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.css' );*/
	wp_enqueue_style( 'nickonstart-izitoast', get_template_directory_uri() . '/assets/iziToast/iziToast.min.css' );
	wp_enqueue_style( 'nickonstart-main', get_template_directory_uri() . '/assets/css/main.css' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'nickonstart-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', [], false, true );
	wp_enqueue_script( 'nickonstart-owl-carousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.js', [], false, true );
	wp_enqueue_script( 'nickonstart-fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', [], false, true );
	/*wp_enqueue_script( 'nickonstart-carousel', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js', [], false, true );
	wp_enqueue_script( 'nickonstart-carousel-thumbs', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.umd.js', [], false, true );*/
	wp_enqueue_script( 'nickonstart-izitoast', get_template_directory_uri() . '/assets/iziToast/iziToast.js', [], false, true );
	wp_enqueue_script( 'nickonstart-jquery-cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', [], false, true );
	wp_enqueue_script( 'nickonstart-main', get_template_directory_uri() . '/assets/js/main.js', [], false, true );

	wp_localize_script( 'nickonstart-main', 'nickonstart_wishlist_object', [
		'is_auth' => is_user_logged_in(),
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'nickonstart-nonce' ),
		'limit' => WISHLIST_LIMIT,
		'error' => __( 'Error while adding to Wishlist', 'nickon-start' ),
		'warning' => __( 'Wait for the operation complete', 'nickon-start' ),
		'reload' => __( 'The page will be reloaded', 'nickon-start' ),
		'remove' => __( 'The product has been removed from wishlist', 'nickon-start' ),
		'success' => __( 'The product has been added to wishlist', 'nickon-start' ),
		'need_auth' => __( 'Please register or login', 'nickon-start' ),
	] );
} );

function nickon_dump( $data ) {
	echo "<pre>" . print_r( $data, 1 ) . "</pre>";
}

require_once get_template_directory() . '/inc/woocommerce-hooks.php';
require_once get_template_directory() . '/inc/class-nickonstart-header-menu.php';
require_once get_template_directory() . '/inc/class-nickonstart-footer-menu.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/custom_post_types.php';
require_once get_template_directory() . '/inc/wishlist.php';
require_once get_template_directory() . '/inc/widgets.php';

