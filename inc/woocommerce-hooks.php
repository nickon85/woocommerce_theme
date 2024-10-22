<?php

add_filter( 'woocommerce_enqueue_styles', '__return_false' ); /* disable default woo styles */

//categories

remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', function ( $category ) {
	echo "<h5 class='mt-2 home-categories-name'>{$category->name} <span>({$category->count})</span></h5>";
}, 10 );

// product card

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/*remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );*/

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', function () {
	global $product;
	echo '<h4><a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a></h4>';
}, 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_filter( 'woocommerce_product_get_rating_html', function ( $html, $rating, $count ) {
	$html  = '';
	$label = sprintf( __( 'Rated %s out of 5', 'nickon-start' ), $rating );
	$html  = '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) . '</div>';

	return $html;
}, 10, 3 );

add_filter( 'woocommerce_product_add_to_cart_text', function () {
	global $product;

	if ( empty( $product ) || ! $product->product_type ) {
		return __( 'Add to Cart', 'nickon-start' );
	}

	// match expression
	/*return match ( $product->product_type ) {
		'external' => $product->button_text,
		'variable' => __( 'Select options', 'nickon-start' ),
		'grouped' => __( 'View products', 'nickon-start' ),
		default => __( 'Add to Cart', 'nickon-start' ),
	};*/

	switch ( $product->product_type ) {
		case 'external':
			return $product->button_text;
		case 'variable':
			return __( 'Select options', 'nickon-start' );
		case 'grouped':
			return __( 'View products', 'nickon-start' );
		case 'simple':
		default:
			return __( 'Add to Cart', 'nickon-start' );
	}
}, 10, 3 );

// custom shortcode
add_shortcode( 'nickonstart_new_products', function ( $atts ) {

	extract( shortcode_atts( [
		'limit'   => '12',
		'orderby' => 'date',
		'order'   => 'DESC'
	], $atts ) );


	$args = [
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'orderby'        => $orderby,
		'order'          => $order,
		'posts_per_page' => $limit,
	];

	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product-slide' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php endif;

	wp_reset_postdata();

	return '<div class="woocommerce"><div class="owl-carousel owl-theme owl-carousel-full">' . ob_get_clean() . '</div></div>';
} );

// Show cart contents/total Ajax
add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
	$fragments['span.cart-badge'] = '<span class="badge text-bg-warning cart-badge bg-warning rounded-circle">' . count( WC()->cart->get_cart() ) . '</span>';

	return $fragments;
} );


// archive products

add_filter( 'woocommerce_breadcrumb_defaults', function () {
	return [
		'delimiter'   => '<i class="fa fa-angle-right"></i>',
		'wrap_before' => '<div class="col-12"><nav class="breadcrumbs"><ul>',
		'wrap_after'  => '</ul></nav></div>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => __( 'Home', 'nickon-start' ),
	];
} );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );

// category archive image
function nickonstart_get_cat_archive_img() {
	$html = '';
	if ( is_product_category() ) {
		global $wp_query;
		$cat          = $wp_query->get_queried_object();
		$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			$html .= '<img class="img-thumbnail" src="' . $image . '" alt="' . $cat->name . '" >';
		}
	}

	return $html;
}


// product page

add_filter( 'woocommerce_product_single_add_to_cart_text', function () {
	return __( 'Add to Cart', 'nickon-start' );
} );

// remove sidebar only on product page
add_action( 'template_redirect', function () {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
} );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Cart

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_action( 'woocommerce_cart_actions', function () {
	echo '<a class="button btn btn-danger" href="' . WC()->cart->get_cart_url() . '?empty-cart">' . __( 'Clear Cart', 'nickon-start' ) . '</a>';
} );

add_action( 'init', function () {
	if ( isset( $_GET['empty-cart'] ) ) {
		WC()->cart->empty_cart();
	}
} );

// Checkout

add_filter( 'woocommerce_default_address_fields', function ( $fields ) {
	unset( $fields['company'], $fields['address_2'], $fields['postcode'] );

	return $fields;
} );

add_filter( 'woocommerce_order_button_html', function ( $button ) {
	$btn = str_replace( 'button alt', 'button alt btn btn-success', $button );

	return '<div class="d-grid mt-3">' . $btn . '</div>';
} );

// Disable password strength script
/*add_action( 'wp_print_scripts', function () {
	wp_dequeue_script( 'wc-password-strength-meter' );
}, 100 );*/

/* WooCommerce Password Strength */
/*add_filter( 'woocommerce_min_password_strength', function () {
	return 1;
});*/