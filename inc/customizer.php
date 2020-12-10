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
			'selector' => '.site-title a',
			'render_callback' => 'emma_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'render_callback' => 'emma_customize_partial_blogdescription',
		) );
	}

	// Add "Alternate Logo" to Site Identity options in customizer
	$wp_customize->add_setting( 'alternate_logo' );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'alternate_logo', array (
		'label' => __( 'Alternate Logo', 'emma' ),
		'section' => 'title_tagline',
		'settings' => 'alternate_logo',
		'priority' => 9,
		'description' => __( 'Typically used for mobile or scrolling versions of the logo.' ),
	) ) );

	// Add theme settings section
	$wp_customize->add_panel( 'theme_settings', array(
		'priority'		=> 30,
		'theme_supports' => '',
		'title' => 'Theme Settings',
		'description' => 'Settings specific to Emma.',
	) );

	$wp_customize->add_section( 'sitewide_alert', array (
		'priority' => 10,
		'theme_supports' => '',
		'title' => 'Sitewide Alert',
		'description' => 'Add an alert at the top of every page',
		'panel' => 'theme_settings',
	) );

	$wp_customize->add_setting( 'sitewide_alert_enable' );
	$wp_customize->add_control( 'sitewide_alert_enable', array(
		'type' => 'checkbox',
		'priority' => 10,
		'section' => 'sitewide_alert',
		'label' => __( 'Enable Sitewide Alert' ),
		'description' => 'alert text must also be entered below for alert to appear',
	) );

	$wp_customize->add_setting( 'sitewide_alert_text' );
	$wp_customize->add_control( 'sitewide_alert_text', array(
		'type' => 'textarea',
		'priority' => 10,
		'section' => 'sitewide_alert',
		'label' => __( 'Alert Text' ),
	) );

	$wp_customize->add_section( 'analytics', array(
		'priority' => 10,
		'theme_supports' => '',
		'title' => 'Analytics',
		'description' => '',
		'panel' => 'theme_settings',
	) );

	$wp_customize->add_setting( 'gtm_id' );
	$wp_customize->add_control( 'gtm_id', array(
		'type' => 'text',
		'priority' => 10,
		'section' => 'analytics',
		'label' => 'Google Tag Manager ID',
		'description'	=> 'Enter the full ID, starting with "GTM-"',
	) );

	$wp_customize->add_section( 'layout', array(
		'priority' => 10,
		'theme_supports' => '',
		'title' => 'Layout',
		'description' => '',
		'panel' => 'theme_settings',
	) );

	$wp_customize->add_setting( 'site_layout' );
	$wp_customize->add_control( 'site_layout', array(
		'type' => 'select',
		'priority' => 10,
		'section' => 'layout',
		'label' => __( 'Site Layout', 'emma' ),
		'choices' => [
			'no-sidebar' => __( 'Content (no sidebar)', 'emma' ),
			'content-sidebar' => __( 'Content + Sidebar', 'emma' ),
			'sidebar-content' => __( 'Sidebar + Content', 'emma' ),
			'sidebar-content-sidebar' => __( 'Sidebar + Content + Sidebar', 'emma' ),
		],
	) );

	$wp_customize->add_section( 'archives', array(
		'priority' => 10,
		'theme_supports' => '',
		'title' => 'Archives',
		'description' => '',
		'panel' => 'theme_settings',
	) );

	$wp_customize->add_setting( 'archive_show_thumbnails' );
	$wp_customize->add_control( 'archive_show_thumbnails', array(
		'type' => 'checkbox',
		'priority' => 10,
		'section' => 'archives',
		'label' => 'Show Thumbnails',
	) );

	$wp_customize->add_setting( 'archive_use_excerpts' );
	$wp_customize->add_control( 'archive_use_excerpts', array(
		'type' => 'checkbox',
		'priority' => 10,
		'section' => 'archives',
		'label' => 'Use Excerpts',
	) );

	$wp_customize->add_section( 'search', array(
		'priority' => 10,
		'theme_supports' => '',
		'title' => 'Search',
		'description' => '',
		'panel' => 'theme_settings',
	) );

	$wp_customize->add_setting( 'search_show_thumbnails' );
	$wp_customize->add_control( 'search_show_thumbnails', array(
		'type' => 'checkbox',
		'priority' => 10,
		'section' => 'search',
		'label' => 'Show Thumbnails',
	) );
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
