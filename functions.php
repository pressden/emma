<?php
/**
 * Emma functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Emma
 */

if ( ! function_exists( 'emma_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function emma_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Emma, use a find and replace
		 * to change 'emma' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'emma', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in five locations.
    register_nav_menus( array(
      'primary'   => esc_html__( 'Primary Menu', 'emma' ),
      'utility'   => esc_html__( 'Utility Menu', 'emma' ),
      'left'      => esc_html__( 'Left Menu', 'emma' ),
      'right'     => esc_html__( 'Right Menu', 'emma' ),
      'footer'    => esc_html__( 'Footer Menu', 'emma' ),
    ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'emma_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
    ) );

    // Add support for full and wide align images.
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'emma_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function emma_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'emma_content_width', 640 );
}
add_action( 'after_setup_theme', 'emma_content_width', 0 );

/**
 * Set the editor color palette, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global array $editor_color_palette
 */
function emma_editor_color_palette() {
  // This variable is intended to be overruled from themes.
  $editor_color_palette = array(
    'primary' => array(
      'name'  => __( 'Primary', 'emma' ),
      'slug'  => 'primary',
      'color'	=> '#0073aa',
    ),
    'primary-support' => array(
      'name'  => __( 'Primary support', 'emma' ),
      'slug'  => 'primary-support',
      'color'	=> '#00a0d2',
    ),
    'secondary' => array(
      'name'  => __( 'Secondary', 'emma' ),
      'slug'  => 'secondary',
      'color' => '#23282d',
    ),
    'secondary-support' => array(
      'name'  => __( 'Secondary support', 'emma' ),
      'slug'  => 'secondary-support',
      'color' => '#a0a5aa',
    ),
    'accent' => array(
      'name'  => __( 'Accent', 'emma' ),
      'slug'  => 'accent',
      'color'	=> '#826eb4',
    ),
    'notice' => array(
      'name'  => __( 'Notice', 'emma' ),
      'slug'  => 'notice',
      'color'	=> '#ffb900',
    ),
    'warning' => array(
      'name'  => __( 'Warning', 'emma' ),
      'slug'  => 'warning',
      'color'	=> '#f56e28',
    ),
    'success' => array(
      'name'  => __( 'Success', 'emma' ),
      'slug'  => 'success',
      'color'	=> '#46b450',
    ),
    'error' => array(
      'name'  => __( 'Error', 'emma' ),
      'slug'  => 'error',
      'color'	=> '#dc3232',
    ),
    'white' => array(
      'name'  => __( 'White', 'emma' ),
      'slug'  => 'white',
      'color'	=> '#fff',
    ),
    'gray-200' => array(
      'name'  => __( 'Gray 200', 'emma' ),
      'slug'  => 'gray-200',
      'color'	=> '#ebebeb',
    ),
    'gray-400' => array(
      'name'  => __( 'Gray 400', 'emma' ),
      'slug'  => 'gray-400',
      'color'	=> '#d3d3d3',
    ),
    'gray-600' => array(
      'name'  => __( 'Gray 600', 'emma' ),
      'slug'  => 'gray-600',
      'color'	=> '#737373',
    ),
    'gray-800' => array(
      'name'  => __( 'Gray 800', 'emma' ),
      'slug'  => 'gray-800',
      'color'	=> '#393939',
    ),
    'black' => array(
      'name'  => __( 'Black', 'emma' ),
      'slug'  => 'black',
      'color'	=> '#000',
    ),
  );

  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['editor_color_palette'] = apply_filters( 'emma_editor_color_palette', $editor_color_palette );

  add_theme_support( 'editor-color-palette', $GLOBALS['editor_color_palette'] );
}
add_action( 'after_setup_theme', 'emma_editor_color_palette', 0 );

/**
 * Register the widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emma_widgets_init() {
  $widget_areas = array(
    'header-widgets' => array(
      'name'  => esc_html__( 'Header Widgets', 'emma' ),
      'id'    => 'header-widgets',
    ),
    'primary-sidebar' => array(
      'name'  => esc_html__( 'Primary Sidebar', 'emma' ),
      'id'    => 'primary-sidebar',
    ),
    'secondary-sidebar' => array(
      'name'  => esc_html__( 'Secondary Sidebar', 'emma' ),
      'id'    => 'secondary-sidebar',
    ),
  );

  // Filter 'emma_utility_widget_areas' in the global scope for use in templates
  $GLOBALS['emma_utility_widget_areas'] = apply_filters( 'emma_utility_widget_areas', 2 );

  // Add the utility widgets areas
  for( $i = 1; $i <= $GLOBALS['emma_utility_widget_areas']; $i++ ) {
    $widget_areas['utility-widgets-' . $i] = array(
      'name'  => esc_html__( "Utility Widgets $i", 'emma' ),
      'id'    => 'utility-widgets-' . $i,
    );
  }

  // Filter 'emma_footer_widget_areas' in the global scope for use in templates
  $GLOBALS['emma_footer_widget_areas'] = apply_filters( 'emma_footer_widget_areas', 3 );

  // Add the footer widgets areas
  for( $i = 1; $i <= $GLOBALS['emma_footer_widget_areas']; $i++ ) {
    $widget_areas['footer-widgets-' . $i] = array(
      'name'  => esc_html__( "Footer Widgets $i", 'emma' ),
      'id'    => 'footer-widgets-' . $i,
    );
  }

  // Filter $widget_areas
  $widget_areas = apply_filters( 'emma_widget_areas', $widget_areas );

  // Register the widget areas
  foreach( $widget_areas as $widget_area_id => $widget_area ) {
    $defaults = array(
      'description'   => esc_html__( 'Add widgets here.', 'emma' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    );

    $widget_area = wp_parse_args( $widget_area, $defaults );

    register_sidebar( $widget_area );
  }
}
add_action( 'widgets_init', 'emma_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function emma_scripts() {
	wp_enqueue_style( 'emma-style', get_stylesheet_uri(), null, wp_get_theme()->get( 'Version' ) );

  wp_enqueue_script( 'emma-scripts', get_stylesheet_directory_uri() . '/dist/app.js', array(), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'emma_scripts' );

/**
 * Optimize WordPress by removing unused features.
 */
require get_template_directory() . '/inc/optimize.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
