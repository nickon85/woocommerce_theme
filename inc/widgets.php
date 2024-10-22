<?php

add_action( 'widgets_init', function () {
	register_sidebar( [
		'name'          => __( 'Shop Sidebar', 'nickon-start' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'nickon-start' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
} );
