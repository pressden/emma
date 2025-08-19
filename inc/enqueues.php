<?php
/**
 * Enqueues
 *
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/
 *
 * @since 2.4
 */

/**
 * Register and enqueue frontend scripts and styles
 */
function emma_enqueue_frontend() {
  $theme_version = wp_get_theme( get_template() )->get( 'Version' );

  $stylesheet = get_template_directory_uri() . '/css/theme.css';
  wp_enqueue_style( 'emma', $stylesheet, null, $theme_version );

  if( is_front_page() ) {
    emma_lazy_load_and_inline_stylesheet( 'emma' );
  }
}
add_action( 'wp_enqueue_scripts', 'emma_enqueue_frontend' );

/**
 * Enqueue backend scripts for stuff that should always get loaded
 */
function emma_enqueue_editor() {
  $theme_version       = wp_get_theme( get_template() )->get( 'Version' );
  $frontend_stylesheet = get_template_directory_uri() . '/css/theme.css';

  wp_enqueue_style( 'emma', $frontend_stylesheet, null, $theme_version );
}
add_action( 'enqueue_block_editor_assets', 'emma_enqueue_editor' );

/**
 * Register flyout menu scripts and styles
 */
function emma_register_flyout_menu() {
	$theme_version = wp_get_theme( get_template() )->get( 'Version' );

  wp_register_script('emma-flyout-early', '', array(), $theme_version, false); // Enqueue a dummy script in head that can be used to add inline scripts

  $flyout_common_stylesheet = get_template_directory_uri() . '/assets/css/flyout-common.css';
  wp_register_style( 'emma-flyout-common', $flyout_common_stylesheet, null, $theme_version );
	$flyout_menu_stylesheet = get_template_directory_uri() . '/assets/css/flyout-menu.css';
	wp_register_style( 'emma-flyout-menu', $flyout_menu_stylesheet, array( 'emma-flyout-common' ), $theme_version );
  $flyout_search_stylesheet = get_template_directory_uri() . '/assets/css/flyout-search.css';
  wp_register_style( 'emma-flyout-search', $flyout_search_stylesheet, array( 'emma-flyout-common' ), $theme_version );

  $flyout_early_file = get_template_directory() . '/assets/js/flyout-early.js';
  if (file_exists($flyout_early_file)) {
    $flyout_early_inline = file_get_contents($flyout_early_file);
    wp_add_inline_script('emma-flyout-early', $flyout_early_inline); // Add inline script to the head dependency
  }  

  $flyout_common_js = get_template_directory_uri() . '/assets/js/flyout-common.js';
  wp_register_script( 'emma-flyout-common', $flyout_common_js, array(), $theme_version, true );
	$flyout_menu_js = get_template_directory_uri() . '/assets/js/flyout-menu.js';
	wp_register_script( 'emma-flyout-menu', $flyout_menu_js, array( 'emma-flyout-common', 'emma-flyout-early' ), $theme_version, true );
  $flyout_search_js = get_template_directory_uri() . '/assets/js/flyout-search.js';
  wp_register_script( 'emma-flyout-search', $flyout_search_js, array( 'emma-flyout-common', 'emma-flyout-early' ), $theme_version, true );
}
add_action( 'init', 'emma_register_flyout_menu' );

/**
 * Iterate through color palette defined in theme.json and output additional styles for theme
 */
function emma_global_styles_supplemental_colors() {
	$global_styles = wp_get_global_settings();
	$color_palette = $global_styles['color']['palette']['theme'];

	$supplemental_css = "";
	foreach( $color_palette as $color ) {
		$slug = $color['slug'];
		$supplemental_css .= ".has-$slug-background-color{--bg-color:var(--wp--preset--color--$slug) !important}";
	}

	wp_add_inline_style( 'global-styles', $supplemental_css );
}
add_action( 'wp_enqueue_scripts', 'emma_global_styles_supplemental_colors', 100 );

/**
 * Look for menu breakpoint in theme.json and, if it exists, output appropriate CSS
 */
function emma_global_styles_menu_breakpoint() {
	$global_styles = wp_get_global_settings();
	$menu_breakpoint = $global_styles['custom']['menuBreakpoint'];

  ob_start();
  ?>
    .wp-block-navigation .flyout-menu-opener:where( :not( .show-on-desktop ) ) {
      display: none;
    }
    @media screen and ( max-width: calc( <?= $menu_breakpoint ?> - 1px ) ) {
      .wp-block-navigation > .wp-block-navigation-item:where( :not( .show-on-mobile ):not( .flyout-menu-opener ) ) {
        display: none;
      }
      .wp-block-navigation .flyout-menu-opener {
        display: block;
      }
    }
  <?php
  $supplemental_css = ob_get_clean();

	wp_add_inline_style( 'global-styles', $supplemental_css );
}
add_action( 'wp_enqueue_scripts', 'emma_global_styles_menu_breakpoint', 100 );