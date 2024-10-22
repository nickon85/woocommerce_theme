<?php

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'nickonstart_theme_options', [
		'title'    => __( 'Contacts settings', 'nickon-start' ),
		'priority' => 1000,
	] );

	//phone 1
	$wp_customize->add_setting( 'nickonstart_phone_1' );
	$wp_customize->add_control( 'nickonstart_phone_1', [
		'label'   => __( 'Phone 1', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

	//phone 2
	$wp_customize->add_setting( 'nickonstart_phone_2' );
	$wp_customize->add_control( 'nickonstart_phone_2', [
		'label'   => __( 'Phone 2', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

	//address
	$wp_customize->add_setting( 'nickonstart_address' );
	$wp_customize->add_control( 'nickonstart_address', [
		'label'   => __( 'Address', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

	//working hours
	$wp_customize->add_setting( 'nickonstart_working_hours' );
	$wp_customize->add_control( 'nickonstart_working_hours', [
		'label'   => __( 'Working hours', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

	//youtube
	$wp_customize->add_setting( 'nickonstart_youtube' );
	$wp_customize->add_control( 'nickonstart_youtube', [
		'label'   => __( 'Youtube link', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

	//facebook
	$wp_customize->add_setting( 'nickonstart_facebook' );
	$wp_customize->add_control( 'nickonstart_facebook', [
		'label'   => __( 'Facebook link', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

	//instagram
	$wp_customize->add_setting( 'nickonstart_instagram' );
	$wp_customize->add_control( 'nickonstart_instagram', [
		'label'   => __( 'Instagram link', 'nickon-start' ),
		'section' => 'nickonstart_theme_options',
	] );

} );

function nickonstart_theme_options() {
	return [
		'phone_1'   => get_theme_mod( 'nickonstart_phone_1' ),
		'phone_2'   => get_theme_mod( 'nickonstart_phone_2' ),
		'address'   => get_theme_mod( 'nickonstart_address' ),
		'working_hours'   => get_theme_mod( 'nickonstart_working_hours' ),
		'youtube'   => get_theme_mod( 'nickonstart_youtube' ),
		'facebook'  => get_theme_mod( 'nickonstart_facebook' ),
		'instagram' => get_theme_mod( 'nickonstart_instagram' ),
	];
}
