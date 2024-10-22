<?php

add_action( 'init', function () {

	register_post_type( 'slider', [
		'public'              => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', ],
		'menu_icon'           => 'dashicons-format-gallery',
		'show_in_rest'        => true,
		'labels'              => [
			'add_new_item'  => __( 'New slide', 'nickon-start' ),
			'edit_item'     => __( 'Edit', 'nickon-start' ),
			'new_item'      => __( 'New slide', 'nickon-start' ),
			'view_item'     => __( 'View', 'nickon-start' ),
			'name'          => __( 'Slider', 'nickon-start' ),
			'singular_name' => __( 'Slider', 'nickon-start' ),
			'add_new'       => __( 'Add new slide', 'nickon-start' ),
			'menu_name'     => __( 'Slider', 'nickon-start' ),
			'all_items'     => __( 'All slides', 'nickon-start' ),
		],
	] );

	register_post_type( 'card', [
		'public'              => true,
		'supports'            => [ 'title', 'editor', ],
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'menu_icon'           => 'dashicons-index-card',
		'show_in_rest'        => true,
		'labels'              => [
			'add_new_item'  => __( 'New card', 'nickon-start' ),
			'edit_item'     => __( 'Edit', 'nickon-start' ),
			'new_item'      => __( 'New card', 'nickon-start' ),
			'view_item'     => __( 'View', 'nickon-start' ),
			'name'          => __( 'Cards', 'nickon-start' ),
			'singular_name' => __( 'Card', 'nickon-start' ),
			'add_new'       => __( 'Add new card', 'nickon-start' ),
			'menu_name'     => __( 'Cards', 'nickon-start' ),
			'all_items'     => __( 'All cards', 'nickon-start' ),
		],
	] );

} );


