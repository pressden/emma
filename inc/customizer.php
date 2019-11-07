<?php
/**
 * Emma Theme Customizer
 *
 * @package Emma
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function emma_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'emma_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'emma_customize_partial_blogdescription',
		) );
	}

	// Add "Alternate Logo" to Site Identity options in customizer
	$wp_customize->add_setting( 'alternate_logo', array(
		'default'		=> '',
		'transport'	=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'alternate_logo', array (
		'label' 			=> __( 'Alternate Logo', 'emma' ),
		'section'			=> 'title_tagline',
		'settings'		=> 'alternate_logo',
		'priority'		=> 9,
		'description'	=> __( 'Typically used for mobile or scrolling versions of the logo.' ),
	) ) );
}
add_action( 'customize_register', 'emma_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function emma_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function emma_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function emma_customize_preview_js() {
	wp_enqueue_script( 'emma-customizer', get_template_directory_uri() . '/src/js/customizer.js', array( 'customize-preview' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'customize_preview_init', 'emma_customize_preview_js' );
