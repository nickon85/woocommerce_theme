<?php

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_classes = ( is_front_page() || is_search() || is_product() || is_page( 'wishlist' ) ) ? 'col-lg-3 col-md-4 col-sm-6 mb-3' : 'col-lg-4 col-sm-6 mb-3';

//	nickon_dump( var_dump(nickonstart_get_wishlist()[3] ));

?>

<div <?php wc_product_class( $product_classes, $product ); ?>>
    <div class="product-card">
        <div class="wishlist-icon <?php echo nickonstart_in_wishlist_db( $product->get_id() ) ? 'in_wishlist' : '' ?>"
             data-id="<?php echo $product->get_id(); ?>"
             title="<?php echo __( 'Wishlist', 'nickon-start' ) ?>">
            <i class="fa-regular fa-heart"></i>
        </div>
        <div class="ajax-loader">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/spinner.svg" alt="">
        </div>
		<?php

		do_action( 'woocommerce_before_shop_loop_item' );
		?>

        <div class="product-thumb">
            <!--<a href="<?php /*the_permalink(); */ ?>">-->               <!--standard WP func -->
            <a href="<?php echo $product->get_permalink() ?>">            <!--Woo func -->
				<?php

				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
            </a>
        </div>

        <div class="product-details">
			<?php

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

				do_action( 'woocommerce_after_shop_loop_item_title' );

				do_action( 'woocommerce_after_shop_loop_item' );
				echo '</div>';
				?>
            </div><!-- ./product-bottom-details -->
        </div><!-- ./product-details -->
    </div><!-- ./product-card -->
</div><!-- ./col-lg-3 col-md-4 col-sm-6 mb-3 -->
