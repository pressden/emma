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
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'emma_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'emma_customize_partial_blogdescription',
			)
		);
	}

	// Add "Alternate Logo" to Site Identity options in customizer.
	$wp_customize->add_setting( 'alternate_logo', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'alternate_logo',
			array(
				'label'       => __( 'Alternate Logo', 'emma' ),
				'section'     => 'title_tagline',
				'settings'    => 'alternate_logo',
				'priority'    => 9,
				'description' => __( 'Typically used for mobile or scrolling versions of the logo.', 'emma' ),
			)
		)
	);

	// Add theme settings section.
	$wp_customize->add_panel(
		'theme_settings',
		array(
			'priority'       => 30,
			'theme_supports' => '',
			'title'          => 'Theme Settings',
			'description'    => 'Settings specific to Emma.',
		)
	);

	$wp_customize->add_section(
		'analytics',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Analytics',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'gtm_id', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'gtm_id',
		array(
			'type'        => 'text',
			'priority'    => 10,
			'section'     => 'analytics',
			'label'       => 'Google Tag Manager ID',
			'description' => 'Enter the full ID, starting with "GTM-"',
		)
	);

	$wp_customize->add_section(
		'layout',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Layout',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'site_layout', array( 'sanitize_callback' => 'sanitize_html_class' ) );
	$wp_customize->add_control(
		'site_layout',
		array(
			'type'     => 'select',
			'priority' => 10,
			'section'  => 'layout',
			'label'    => __( 'Site Layout', 'emma' ),
			'choices'  => array(
				'no-sidebar'              => __( 'Content (no sidebar)', 'emma' ),
				'content-sidebar'         => __( 'Content + Sidebar', 'emma' ),
				'sidebar-content'         => __( 'Sidebar + Content', 'emma' ),
				'sidebar-content-sidebar' => __( 'Sidebar + Content + Sidebar', 'emma' ),
			),
		)
	);

	$wp_customize->add_section(
		'homepage',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Homepage',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'homepage_show_thumbnails', array( 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'homepage_show_thumbnails',
		array(
			'type'     => 'checkbox',
			'priority' => 10,
			'section'  => 'homepage',
			'label'    => 'Show Featured Image',
		)
	);

	$wp_customize->add_section(
		'archives',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Archives',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'archive_show_thumbnails', array( 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'archive_show_thumbnails',
		array(
			'type'     => 'checkbox',
			'priority' => 10,
			'section'  => 'archives',
			'label'    => 'Show Thumbnails',
		)
	);

	$wp_customize->add_setting( 'archive_use_excerpts', array( 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'archive_use_excerpts',
		array(
			'type'     => 'checkbox',
			'priority' => 10,
			'section'  => 'archives',
			'label'    => 'Use Excerpts',
		)
	);

	$wp_customize->add_section(
		'search',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Search',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'search_show_thumbnails', array( 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'search_show_thumbnails',
		array(
			'type'     => 'checkbox',
			'priority' => 10,
			'section'  => 'search',
			'label'    => 'Show Thumbnails',
		)
	);

	$wp_customize->add_section(
		'posts',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Posts',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'post_show_thumbnails', array( 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'post_show_thumbnails',
		array(
			'type'     => 'checkbox',
			'priority' => 10,
			'section'  => 'posts',
			'label'    => 'Show Featured Image',
		)
	);

	$wp_customize->add_section(
		'pages',
		array(
			'priority'       => 10,
			'theme_supports' => '',
			'title'          => 'Pages',
			'description'    => '',
			'panel'          => 'theme_settings',
		)
	);

	$wp_customize->add_setting( 'page_show_thumbnails', array( 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'page_show_thumbnails',
		array(
			'type'     => 'checkbox',
			'priority' => 10,
			'section'  => 'pages',
			'label'    => 'Show Featured Image',
		)
	);
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
	wp_enqueue_script(
		'emma-customizer',
		get_template_directory_uri() . '/src/js/customizer.js',
		array( 'customize-preview' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'emma_customize_preview_js' );
