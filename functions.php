<?php
/**
 * Emma functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Emma
 */

if ( ! function_exists( 'emma_setup' ) ) {
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

		/*
		 * Register navigation menus.
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'emma' ),
				'left'    => esc_html__( 'Left Menu', 'emma' ),
				'right'   => esc_html__( 'Right Menu', 'emma' ),
				'footer'  => esc_html__( 'Footer Menu', 'emma' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'emma_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
	}
}
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
		'primary'           => array(
			'name'  => __( 'Primary', 'emma' ),
			'slug'  => 'primary',
			'color' => '#0073aa',
		),
		'primary-support'   => array(
			'name'  => __( 'Primary support', 'emma' ),
			'slug'  => 'primary-support',
			'color' => '#d4f9f8',
		),
		'secondary'         => array(
			'name'  => __( 'Secondary', 'emma' ),
			'slug'  => 'secondary',
			'color' => '#663f46',
		),
		'secondary-support' => array(
			'name'  => __( 'Secondary support', 'emma' ),
			'slug'  => 'secondary-support',
			'color' => '#b8d8d8',
		),
		'accent'            => array(
			'name'  => __( 'Accent', 'emma' ),
			'slug'  => 'accent',
			'color' => '#d34e24',
		),
		'white'             => array(
			'name'  => __( 'White', 'emma' ),
			'slug'  => 'white',
			'color' => '#fff',
		),
		'gray-200'          => array(
			'name'  => __( 'Gray 200', 'emma' ),
			'slug'  => 'gray-200',
			'color' => '#ebebeb',
		),
		'gray-400'          => array(
			'name'  => __( 'Gray 400', 'emma' ),
			'slug'  => 'gray-400',
			'color' => '#d3d3d3',
		),
		'gray-600'          => array(
			'name'  => __( 'Gray 600', 'emma' ),
			'slug'  => 'gray-600',
			'color' => '#737373',
		),
		'gray-800'          => array(
			'name'  => __( 'Gray 800', 'emma' ),
			'slug'  => 'gray-800',
			'color' => '#393939',
		),
		'black'             => array(
			'name'  => __( 'Black', 'emma' ),
			'slug'  => 'black',
			'color' => '#000',
		),
		'success'           => array(
			'name'  => __( 'Success', 'emma' ),
			'slug'  => 'success',
			'color' => '#46b450',
		),
		'warning'           => array(
			'name'  => __( 'Warning', 'emma' ),
			'slug'  => 'warning',
			'color' => '#f56e28',
		),
		'danger'            => array(
			'name'  => __( 'Danger', 'emma' ),
			'slug'  => 'danger',
			'color' => '#dc3232',
		),
	);

	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['editor_color_palette'] = apply_filters( 'emma_editor_color_palette', $editor_color_palette );

	add_theme_support( 'editor-color-palette', array_values( $GLOBALS['editor_color_palette'] ) );
	add_theme_support( 'experimental-custom-spacing' );
	add_theme_support( 'experimental-link-color' );
}
add_action( 'after_setup_theme', 'emma_editor_color_palette', 0 );

/**
 * Set the editor font sizes, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global array $editor_font_sizes
 */
function emma_editor_font_sizes() {
	// This variable is intended to be overruled from themes.
	$editor_font_sizes = array(
		'small'  => array(
			'name' => __( 'Small', 'emma' ),
			'size' => 14,
			'slug' => 'small',
		),
		'normal' => array(
			'name' => __( 'Normal', 'emma' ),
			'size' => 16,
			'slug' => 'normal',
		),
		'medium' => array(
			'name' => __( 'Medium', 'emma' ),
			'size' => 20,
			'slug' => 'medium',
		),
		'large'  => array(
			'name' => __( 'Large', 'emma' ),
			'size' => 36,
			'slug' => 'large',
		),
		'huge'   => array(
			'name' => __( 'Huge', 'emma' ),
			'size' => 48,
			'slug' => 'huge',
		),
		'giant'  => array(
			'name' => __( 'Giant', 'emma' ),
			'size' => 72,
			'slug' => 'giant',
		),
	);

	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['editor_font_sizes'] = apply_filters( 'emma_editor_font_sizes', $editor_font_sizes );

	add_theme_support( 'editor-font-sizes', array_values( $GLOBALS['editor_font_sizes'] ) );
}
add_action( 'after_setup_theme', 'emma_editor_font_sizes', 0 );

/**
 * Register the widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emma_widgets_init() {
	$widget_areas = array(
		'sitewide-alert'    => array(
			'name'        => esc_html__( 'Sitewide Alert', 'emma' ),
			'id'          => 'sitewide-alert',
			'description' => esc_html__( 'These widgets appear at the top of every page in case of emergency. For best results, use only a single Text widget with a short message.', 'emma' ),
		),
		'header-widgets'    => array(
			'name'        => esc_html__( 'Header Widgets', 'emma' ),
			'id'          => 'header-widgets',
			'description' => esc_html__( 'Add widgets to the site header.', 'emma' ),
		),
		'primary-sidebar'   => array(
			'name'        => esc_html__( 'Primary Sidebar', 'emma' ),
			'id'          => 'primary-sidebar',
			'description' => esc_html__( 'Add widgets to pages that contain a sidebar.', 'emma' ),
		),
		'secondary-sidebar' => array(
			'name'        => esc_html__( 'Secondary Sidebar', 'emma' ),
			'id'          => 'secondary-sidebar',
			'description' => esc_html__( 'Add widgets to pages that support a secondary sidebar.', 'emma' ),
		),
	);

	// Filter 'emma_utility_widget_areas' in the global scope for use in templates.
	$GLOBALS['emma_utility_widget_areas'] = apply_filters( 'emma_utility_widget_areas', 2 );

	// Add the utility widgets areas.
	for ( $i = 1; $i <= $GLOBALS['emma_utility_widget_areas']; $i++ ) {
		$widget_areas[ 'utility-widgets-' . $i ] = array(
			'name'        => esc_html__( 'Utility Widgets', 'emma' ) . "  $i",
			'id'          => 'utility-widgets-' . $i,
			'description' => esc_html__( 'Add widgets to the utility bar at the top of the page', 'emma' ) . ' (' . esc_html__( 'column', 'emma' ) . " $i).",
		);
	}

	// Filter 'emma_footer_widget_areas' in the global scope for use in templates.
	$GLOBALS['emma_footer_widget_areas'] = apply_filters( 'emma_footer_widget_areas', 3 );

	// Add the footer widgets areas.
	for ( $i = 1; $i <= $GLOBALS['emma_footer_widget_areas']; $i++ ) {
		$widget_areas[ 'footer-widgets-' . $i ] = array(
			'name'        => esc_html__( 'Footer Widgets', 'emma' ) . " $i",
			'id'          => 'footer-widgets-' . $i,
			'description' => esc_html__( 'Add widgets above the site footer', 'emma' ) . ' (' . esc_html__( 'column', 'emma' ) . " $i).",
		);
	}

	// Filter $widget_areas.
	$widget_areas = apply_filters( 'emma_widget_areas', $widget_areas );

	// Register the widget areas.
	foreach ( $widget_areas as $widget_area_id => $widget_area ) {
		$defaults = array(
			'description'   => esc_html__( 'Add widgets here.', 'emma' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);

		$widget_area = wp_parse_args( $widget_area, $defaults );

		register_sidebar( $widget_area );
	}
}
add_action( 'widgets_init', 'emma_widgets_init' );

/**
 * Filter the navigation menu widget.
 *
 * This filter adds a consistent `container_class` to the navigation menu widget
 * allowing menus to be styled consistently throughout the theme with minimal effort.
 *
 * @param array $nav_menu_args Array of nav menu arguments.
 */
function emma_filter_nav_menu_args( $nav_menu_args ) {
	$nav_menu_args['container_class'] = 'menu-container';
	return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args', 'emma_filter_nav_menu_args' );

// Optimize WordPress by removing unused features.
require get_template_directory() . '/inc/optimize.php';

// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Functions which load template parts by hooking into Emma actions.
require get_template_directory() . '/inc/template-parts.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Menu additions.
require get_template_directory() . '/inc/menu-functions.php';

// Pagination.
require get_template_directory() . '/inc/pagination.php';

// Custom blocks.
require get_template_directory() . '/inc/enqueues.php';

// WooCommerce customizations.
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Enqueue scripts and styles.
 */
function emma_scripts() {
	wp_enqueue_style( 'emma-style', get_stylesheet_directory_uri() . '/dist/theme.css', null, wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'emma-scripts', get_stylesheet_directory_uri() . '/dist/theme.js', null, wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'emma_scripts' );

/**
 * Get the layout. Post layout settings override the site layout setting.
 *
 * @param integer $post_id Post ID.
 */
function emma_get_layout_option( $post_id = null ) {
	$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();

	// Default layout.
	$default_layout = 'no-sidebar';

	// Site layout (overrides default).
	$site_layout = get_theme_mod( 'site_layout', $default_layout );

	// Exit early if no $post_id is found.
	if ( ! $post_id ) {
		return $site_layout;
	}

	// Post layout (overrides site layout).
	if ( is_home() ) {
		$post_layout = get_post_meta( get_option( 'page_for_posts' ), 'post_layout', true );
	} else {
		$post_layout = get_post_meta( get_the_ID(), 'post_layout', true );
	}

	$post_layout = ! empty( $post_layout ) ? $post_layout : $site_layout;

	return $post_layout;
}

/**
 * Check post thumbnail visibility within the loop
 */
function emma_show_post_thumbnail() {
	if (
		post_password_required()
		|| is_attachment()
		|| ! has_post_thumbnail()
		|| ( is_search() && ! get_theme_mod( 'search_show_thumbnails', false ) )
		|| ( ( is_home() || is_archive() ) && ! get_theme_mod( 'archive_show_thumbnails', false ) )
		|| ( is_front_page() && ! get_theme_mod( 'homepage_show_thumbnails', false ) )
		|| ( is_single() && ! get_theme_mod( 'post_show_thumbnails', false ) )
		|| ( is_page() && ! get_theme_mod( 'page_show_thumbnails', false ) )
	) {
		return false;
	}

	return true;
}

/**
 * Filter `post_class` output for `has-post-thumbnail` based on thumbnail visibility
 *
 * @param array $classes Array of classes.
 */
function emma_has_post_thumbnail_filter( $classes ) {
	$key = array_search( 'has-post-thumbnail', $classes, true );

	// Remove `has-post-thumbnail` if the thumbnail is not visible.
	if ( false !== $key && ! emma_show_post_thumbnail() ) {
		unset( $classes[ $key ] );
	}

	return $classes;
}
add_filter( 'post_class', 'emma_has_post_thumbnail_filter' );

/**
 * Add Reusable Blocks to the admin menu
 */
function emma_reusable_blocks_admin_menu() {
	add_menu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_menu_page
		'Reusable Blocks',
		'Reusable Blocks',
		'edit_posts',
		'edit.php?post_type=wp_block',
		'',
		'dashicons-editor-table',
		22
	);
}
add_action( 'admin_menu', 'emma_reusable_blocks_admin_menu' );

/**
 * Simulate non-empty content to enable Gutenberg editor on the main blog page
 *
 * A bit hacky, but it's the only available solution for now.
 *
 * @param boolean $replace Boolean flag to indicate replacement intent.
 * @param object  $post Post object.
 */
function emma_enable_gutenberg_editor_for_blog_page( $replace, $post ) {
	if ( ! $replace && absint( get_option( 'page_for_posts' ) ) === $post->ID && empty( $post->post_content ) ) {
		// This comment will be removed by Gutenberg since it won't parse into block.
		$post->post_content = '<!--non-empty-content-->';
	}
	return $replace;
}
add_filter( 'replace_editor', 'emma_enable_gutenberg_editor_for_blog_page', 10, 2 );

/**
 * Output search form with custom classes
 */
function emma_get_search_form() {
	// Add the custom class filter to the search form.
	add_filter( 'get_search_form', 'emma_search_form_class_filter', 10, 2 );

	get_search_form();

	// Remove the custom class filter to avoid affecting other search forms.
	remove_filter( 'get_search_form', 'emma_search_form_class_filter', 10, 2 );
}
add_action( 'emma_after', 'emma_get_search_form' );

/**
 * Filter the search form to apply custom classes to the markup
 *
 * @param string $form Search form markup.
 * @param array  $args Arguments.
 */
function emma_search_form_class_filter( $form, $args ) {
	// Get the position of the native "search-form" class plus offset (custom after native).
	$string_position = strpos( $form, 'search-form' ) + 11;

	// Return $form with custom classes injected into the markup.
	return substr_replace( $form, ' toggle-search-form d-none', $string_position, 0 );
}
