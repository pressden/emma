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
    'status-widgets' => array(
      'name'          => esc_html__( 'Status Widgets', 'emma' ),
      'id'            => 'status-widgets',
      'description'   => esc_html__( 'Status widgets appear at the top of every page in case of emergency.', 'emma' ),
    ),
    'header-widgets' => array(
      'name'          => esc_html__( 'Header Widgets', 'emma' ),
      'id'            => 'header-widgets',
      'description'   => esc_html__( 'Add widgets to the site header.', 'emma' ),
    ),
    'primary-sidebar' => array(
      'name'          => esc_html__( 'Primary Sidebar', 'emma' ),
      'id'            => 'primary-sidebar',
      'description'   => esc_html__( 'Add widgets to pages that contain a sidebar.', 'emma' ),
    ),
    'secondary-sidebar' => array(
      'name'          => esc_html__( 'Secondary Sidebar', 'emma' ),
      'id'            => 'secondary-sidebar',
      'description'   => esc_html__( 'Add widgets to pages that support a secondary sidebar.', 'emma' ),
    ),
  );

  // Filter 'emma_utility_widget_areas' in the global scope for use in templates
  $GLOBALS['emma_utility_widget_areas'] = apply_filters( 'emma_utility_widget_areas', 2 );

  // Add the utility widgets areas
  for( $i = 1; $i <= $GLOBALS['emma_utility_widget_areas']; $i++ ) {
    $widget_areas['utility-widgets-' . $i] = array(
      'name'          => esc_html__( "Utility Widgets $i", 'emma' ),
      'id'            => 'utility-widgets-' . $i,
      'description'   => esc_html__( 'Add widgets to the utility bar at the top of the page (column ' . $i .').', 'emma' ),
    );
  }

  // Filter 'emma_footer_widget_areas' in the global scope for use in templates
  $GLOBALS['emma_footer_widget_areas'] = apply_filters( 'emma_footer_widget_areas', 3 );

  // Add the footer widgets areas
  for( $i = 1; $i <= $GLOBALS['emma_footer_widget_areas']; $i++ ) {
    $widget_areas['footer-widgets-' . $i] = array(
      'name'          => esc_html__( "Footer Widgets $i", 'emma' ),
      'id'            => 'footer-widgets-' . $i,
      'description'   => esc_html__( 'Add widgets above the site footer (column ' . $i .').', 'emma' ),
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
 * Filter the navigation menu widget.
 *
 * This filter adds a consistent `container_class` to the navigation menu widget
 * allowing menus to be styled consistently throughout the theme with minimal effort.
 */
function emma_filter_nav_menu_args( $nav_menu_args ) {
  $nav_menu_args['container_class'] = 'menu-container';
  return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args', 'emma_filter_nav_menu_args' );

/**
 * Register jQuery
 */
function emma_register_jquery() {
  // deregister the severely outdated version of jQuery that ships with WordPress
  wp_deregister_script( 'jquery' );

  // register a newer version of jQuery
  wp_register_script( 'jquery', get_template_directory_uri() . '/src/vendor/jquery/jquery.min.js', false, '3.4.1' );
}
add_action( 'wp_enqueue_scripts', 'emma_register_jquery' );

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
 * Functions which load template parts by hooking into Emma actions.
 */
require get_template_directory() . '/inc/template-parts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Menu additions.
 */
require get_template_directory() . '/inc/menu-functions.php';

/**
 * Pagination.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Structured Data.
 */
require get_template_directory() . '/inc/structured-data.php';

/**
 * Custom blocks.
 */
require get_template_directory() . '/inc/custom-blocks/register.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Enqueue scripts and styles.
 */
function emma_scripts() {
  // enqueue dashicons for use on the frontend
  wp_enqueue_style( 'dashicons' );

  wp_enqueue_style( 'emma-style', get_stylesheet_directory_uri() . '/dist/app.css', null, wp_get_theme()->get( 'Version' ) );

  wp_enqueue_script( 'emma-scripts', get_stylesheet_directory_uri() . '/dist/app.js', array(), wp_get_theme()->get( 'Version' ), true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'emma_scripts' );

/**
 * Declare WooCommerce theme support.
 */
function emma_declare_woocommerce_support() {
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Add the chosen featured image to the top of the product page
 */
function emma_add_product_page_featured_image( $array ) {
  if( is_shop() ) {
    echo "<div class='shop-featured-image'>" . get_the_post_thumbnail( get_option( 'woocommerce_shop_page_id' ) ) . "</div>";
  }
}

/**
 * Add an opening div before the product sorting on the shop page
 */
function emma_add_product_sorting_open_div() {
  echo "<div class='woocommerce-product-sorting'>";
}

/**
 * Adds column sizer buttons on shop page
 */
function emma_add_product_sorting_column_sizer() {
  $default_columns = apply_filters('loop_shop_columns', 2);
?>
  <ul class='woocommerce-columns-sizers'>
    <li class='woocommerce-columns-sizer columns-1 <?php echo $default_columns == '1' ? 'active' : ''; ?>'>
      <a href='#' data-size="columns-1">
        <span class="screen-reader-text">Make Columns Small Size</span>
        <svg xmlns="http://www.w3.org/2000/svg" tabindex=-1 preserveAspectRatio="xMidYMin meet" viewBox="0 0 24 24"><rect tabindex=-1 x="18" y="9" width="6" height="6"/><rect tabindex=-1 x="18" y="18" width="6" height="6"/><rect tabindex=-1 x="9" y="18" width="6" height="6"/><rect tabindex=-1 y="18" width="6" height="6"/><rect tabindex=-1 x="9" y="9" width="6" height="6"/><rect tabindex=-1 y="9" width="6" height="6"/><rect tabindex=-1 x="9" width="6" height="6"/><rect tabindex=-1 width="6" height="6"/><rect tabindex=-1 x="18" width="6" height="6"/></svg>
      </a>
    </li>
    <li class='woocommerce-columns-sizer columns-2 <?php echo $default_columns == '2' ? 'active' : ''; ?>'>
      <a href='#' data-size="columns-2">
        <span class="screen-reader-text">Make Columns Medium Size</span>
        <svg xmlns="http://www.w3.org/2000/svg" tabindex=-1 preserveAspectRatio="xMidYMin meet" viewBox="0 0 24 24"><rect tabindex=-1 width="10" height="10"/><rect tabindex=-1 x="14" width="10" height="10"/><rect tabindex=-1 x="14" y="14" width="10" height="10"/><rect tabindex=-1 y="14" width="10" height="10"/></svg>
      </a>
    </li>
    <li class='woocommerce-columns-sizer columns-3 <?php echo $default_columns == '3' ? 'active' : ''; ?>'>
      <a href='#' data-size="columns-3">
        <span class="screen-reader-text">Make Columns Large Size</span>
        <svg xmlns="http://www.w3.org/2000/svg" tabindex=-1 preserveAspectRatio="xMidYMin meet" viewBox="0 0 24 24"><rect tabindex=-1 width="24" height="24"/></svg>
      </a>
    </li>
  </ul>
<?php }

/**
 * Add a closing div (initially for use after the product sorting on the shop page, but could be used elsewhere)
 */
function emma_add_close_div() {
  echo '</div>';
}

/**
 * Hijack the old column count hook in WooCommerce to insert our custom column definition class (sm, md, lg)
 */
function emma_product_columns() {
  $default_columns = 2; //change to adjust default | 1 = SM, 2 = MD, 3 = LG
  return $default_columns;
}

/**
 * Set a default column count for related products as well
 */
function emma_related_product_columns( $args ) {
  $default_columns = 2; //change to adjust default | 1 = SM, 2 = MD, 3 = LG
  $args['columns'] = $default_columns;
  return $args;
}

/**
 * Hard set the number of items shown on the shop page so that the product_columns number doesn't mess with it
 */
function emma_products_per_page( $products ) {
  $products = 12;
  return $products;
}

/**
 * Adds the cart anchor markup to WC's cart fragments
 */
function emma_cart_anchor_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
  <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
    <span class='cart-count'><?php echo WC()->cart->get_cart_contents_count() == 0 ? '' : WC()->cart->get_cart_contents_count(); ?></span>
    <?php echo WC()->cart->get_cart_contents_count() == 0 ? 'Cart Empty' : 'Item(s) in Cart'; ?>
  </a>
	<?php
	$fragments['.mini-cart-toggle > a'] = ob_get_clean();
	return $fragments;
}

/**
 * Hooks to run if WooCommerce is installed and active
 */
if ( class_exists( 'WooCommerce' ) ) {
  add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' ); // dequeue default woocommerce styles
  add_action( 'after_setup_theme', 'emma_declare_woocommerce_support' ); // declare theme and product-gallery support
  add_action( 'woocommerce_before_main_content', 'emma_add_product_page_featured_image', 10, 2 );
  add_action( 'woocommerce_before_shop_loop', 'emma_add_product_sorting_open_div', 19 ); // this happens right before the note of how many products are shown on the shop page
  add_action( 'woocommerce_before_shop_loop', 'emma_add_product_sorting_column_sizer', 25 ); // this happens between the results count and the sorting method
  add_action( 'woocommerce_before_shop_loop', 'emma_add_close_div', 31 ); // this happens right after the sorting form on the shop page
  add_filter( 'loop_shop_columns', 'emma_product_columns');
  add_filter( 'woocommerce_output_related_products_args', 'emma_related_product_columns', 20 );
  add_filter( 'loop_shop_per_page', 'emma_products_per_page', 20 );
  add_filter( 'woocommerce_add_to_cart_fragments', 'emma_cart_anchor_fragment' );
  wp_enqueue_script( 'emma-woocommerce-scripts', get_template_directory_uri() . '/src/js/woocommerce.js', array(), wp_get_theme()->get( 'Version' ), true ); // enqueue woocommerce js
}

/**
 * Enqueue Ninja Forms Google Analytics submission event scripts when form is rendered
 */
function emma_ninja_forms_custom() {
  wp_enqueue_script( 'emma-ninja-forms-custom', get_template_directory_uri() . '/src/ninja-forms-custom.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'ninja_forms_enqueue_scripts', 'emma_ninja_forms_custom', 10, 2 );
