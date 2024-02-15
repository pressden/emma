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

	$wp_customize->add_setting( 'early_header_scripts' );
	$wp_customize->add_control(
		'early_header_scripts',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'emma_scripts',
			'label'       => __( 'Early Header Scripts', 'emma' ),
			'description' => __( 'This code will output as early as possible after the opening <code>' . esc_html( '<head>' ) . '</code> tag in the document source.', 'emma' ),
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
			'description' => __( 'This code will output immediately before the closing <code>' . esc_html( '</head>' ) . '</code> tag in the document source.', 'emma' ),
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
			'description' => __( 'This code will output immediately before the closing <code>' . esc_html( '</body>' ) . '</code> tag in the document source.', 'emma' ),
		)
	);
}
add_action( 'customize_register', 'emma_customize_register' );

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