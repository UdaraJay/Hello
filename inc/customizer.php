<?php
/**
 * hello Theme Customizer
 *
 * @package hello
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hello_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	// $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	// $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'hello_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'hello_customize_partial_blogdescription',
		) );
	}

	// Add Homepage Customizer
	$wp_customize->add_section('hello_homepage', array(
		'title' => 'Homepage',
		'description' => 'Options to edit your homepage',
		'priority' => 20,
	));

	$wp_customize->add_setting( 'homepage_title' , array(
	    'default'   => 'Hello.',
	    'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'homepage_des' , array(
	    'default'   => 'Type your bio here.',
	    'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'say_hello_link' , array(
	    'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_title', array(
		'label'      => __( 'Title', 'hello' ),
		'section'    => 'hello_homepage',
		'settings'   => 'homepage_title',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_des', array(
		'label'      => __( 'Bio', 'hello' ),
		'section'    => 'hello_homepage',
		'type'     => 'textarea',
		'settings'   => 'homepage_des',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'say_hello_link', array(
		'label'      => __( 'Say Hello link', 'hello' ),
		'description'      => 'Can be a mailto link or a link to a contact form',
		'section'    => 'hello_homepage',
		'settings'   => 'say_hello_link',
	) ) );


}
add_action( 'customize_register', 'hello_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hello_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hello_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hello_customize_preview_js() {
	wp_enqueue_script( 'hello-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'hello_customize_preview_js' );
