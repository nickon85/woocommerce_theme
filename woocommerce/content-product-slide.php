<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
//nickon_dump($product);
?>

<div <?php wc_product_class( 'product-card', $product ); ?>>
    <div class="wishlist-icon <?php echo nickonstart_in_wishlist_db( $product->get_id() ) ? 'in_wishlist' : '' ?>"
         data-id="<?php echo $product->get_id(); ?>"
         title="<?php echo __( 'Wishlist', 'nickon-start' ) ?>">
        <i class="fa-regular fa-heart"></i>
    </div>
    <div class="ajax-loader">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/spinner.svg" alt="">
    </div>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>

    <div class="product-thumb">
        <!--<a href="<?php /*the_permalink(); */ ?>">-->               <!--standard WP func -->
        <a href="<?php echo $product->get_permalink() ?>">            <!--Woo func -->
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
        </a>
    </div>

    <div class="product-details">
		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

        <div class="product-excerpt mb-2"><?php the_content( '' ); ?></div>

        <div class="product-bottom-details">
			<?php

			echo '<div class="star-rating-wrapper">';
			woocommerce_template_loop_rating();
			$rating_count = $product->get_rating_count();
			echo '<div class="rating-count-wrapper"><span>(' . $rating_count . ')</span></div>';
			echo '</div>';

			echo '<div class="text-center">';
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			echo '</div>';
			?>
        </div><!-- ./product-bottom-details -->
    </div><!-- ./product-details -->
</div><!-- ./product-card -->
