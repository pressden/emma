<?php
/**
 * Customizer
 *
 * @link https://developer.wordpress.org/themes/customize-api/
 *
 * @since 0.1
 */

/**
 * Activate customizer (disabled by default in block themes)
 */
add_action( 'customize_register', '__return_true' );

/**
 * Add cusotmizer settings
 */
function emma_customize_register( $wp_customize ) {
  $wp_customize->add_section(
		'emma_scripts',
		array(
			'priority'       => 100,
			'theme_supports' => '',
			'title'          => __( 'Header/Footer Scripts', 'emma' ),
			'description'    => '',
		)
	);

	$wp_customize->add_setting( 'early_homepage_header_scripts' );
	$wp_customize->add_control(
		'early_homepage_header_scripts',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'emma_scripts',
			'label'       => __( 'Early Homepage Header Scripts', 'emma' ),
			'description' => __( 'This code will output as early as possible after the opening <code>' . esc_html( '<head>' ) . '</code> tag on the homepage. Useful for preloading the homepage LCP image.', 'emma' ),
		)
	);

	$wp_customize->add_setting( 'early_header_scripts' );
	$wp_customize->add_control(
		'early_header_scripts',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'emma_scripts',
			'label'       => __( 'Early Header Scripts', 'emma' ),
			'description' => __( 'This code will output as early as possible after the opening <code>' . esc_html( '<head>' ) . '</code> tag on all pages.', 'emma' ),
		)
	);

	$wp_customize->add_setting( 'late_header_scripts' );
	$wp_customize->add_control(
		'late_header_scripts',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'emma_scripts',
			'label'       => __( 'Late Header Scripts', 'emma' ),
			'description' => __( 'This code will output immediately before the closing <code>' . esc_html( '</head>' ) . '</code> tag on all pages.', 'emma' ),
		)
	);

	$wp_customize->add_setting( 'footer_scripts' );
	$wp_customize->add_control(
		'footer_scripts',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'emma_scripts',
			'label'       => __( 'Footer Scripts', 'emma' ),
			'description' => __( 'This code will output immediately before the closing <code>' . esc_html( '</body>' ) . '</code> tag on all pages.', 'emma' ),
		)
	);

	$wp_customize->add_section(
		'emma_updates',
		array(
			'priority'       => 100,
			'theme_supports' => '',
			'title'          => __( 'Update Settings', 'emma' ),
			'description'    => '',
		)
	);

	$wp_customize->add_setting( 'disable_automatic_updates' );
	$wp_customize->add_control(
		'disable_automatic_updates',
		array(
			'type'        => 'checkbox',
			'priority'    => 10,
			'section'     => 'emma_updates',
			'label'       => __( 'Disable Automatic Updates', 'emma' ),
			'description' => __( 'Disables all WordPress, theme, and plugin automatic updates.', 'emma' ),
		)
	);
}
add_action( 'customize_register', 'emma_customize_register' );

/**
 * Echo early homepage header scripts into wp_head().
 */
function emma_early_homepage_header_scripts() {
	if ( is_front_page() ) {
		echo get_theme_mod( 'early_homepage_header_scripts' );
	}
}
add_action( 'wp_head', 'emma_early_homepage_header_scripts', 1 );

/**
 * Echo early header scripts into wp_head().
 */
function emma_early_header_scripts() {
	echo get_theme_mod( 'early_header_scripts' );
}
add_action( 'wp_head', 'emma_early_header_scripts', 1 );

/**
 * Echo late header scripts into wp_head().
 */
function emma_late_header_scripts() {
	echo get_theme_mod( 'late_header_scripts' );
}
add_action( 'wp_head', 'emma_late_header_scripts', 100 );

/**
 * Echo footer scripts into wp_footer().
 */
function emma_footer_scripts() {
	echo get_theme_mod( 'footer_scripts' );
}
add_action( 'wp_footer', 'emma_footer_scripts' );

/**
 * Disables automatic updates if option is selected
 */
function emma_disabled_automatic_updates() {
	if( get_theme_mod( 'disable_automatic_updates' ) ) {
		return true;
	}
	return false;
}
add_filter( 'automatic_updater_disabled', 'emma_disabled_automatic_updates' );