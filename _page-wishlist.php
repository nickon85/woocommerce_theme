<?php /* Template Name: Wishlist page */ ?>

<?php get_header(); ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="col-12">
    <h1 class="section-title h3 mb-3"><span><?php the_title() ?></span></h1>

    <?php if ( is_user_logged_in() ): ?>
        <?php if ( defined( 'WISHLIST' ) ): ?>
		    <?php $wishlist = implode( ',', WISHLIST ); ?>
		    <?php if ( ! $wishlist ): ?>
                <p><?php _e( 'Wishlist is empty', 'nickon-start' ); ?></p>
		    <?php else: ?>
			    <?php echo do_shortcode( "[products ids='$wishlist' limit=" . WISHLIST_LIMIT . "]" ) ?>
		    <?php endif; ?>
	    <?php endif; ?>
    <?php else: ?>
        <p><?php _e( 'Please register or login', 'nickon-start' ); ?></p>
    <?php endif; ?>

	<?php
    //non DB method
	/*$wishlist = nickonstart_get_wishlist();
	$wishlist = implode( ',', $wishlist );
	*/?><!--

	<?php /*if ( ! $wishlist ): */?>
        <p><?php /*_e( 'Wishlist is empty', 'nickon-start' ); */?></p>
	<?php /*else: */?>
		<?php /*echo do_shortcode( "[products ids='$wishlist' limit=" . WISHLIST_LIMIT . "]" ) */?>
	--><?php /*endif; */?>

</div>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>

