<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @since 0.1
 */

// Shortcodes.
require_once get_template_directory() . '/inc/shortcodes.php';
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Register and enqueue frontend scripts and styles
 */
function emma_enqueue_frontend() {
  $theme_version = wp_get_theme( get_template() )->get( 'Version' );

  $stylesheet = get_template_directory_uri() . '/style.css';
  wp_enqueue_style( 'emma', $stylesheet, null, $theme_version );

  $flyout_menu_js = get_template_directory_uri() . '/flyout-menu.js';
  wp_enqueue_script( 'emma-flyout-menu', $flyout_menu_js, null, $theme_version );
}
add_action( 'wp_enqueue_scripts', 'emma_enqueue_frontend' );

/**
 * Enqueue backend scripts for stuff that should always get loaded
 */
function emma_enqueue_editor() {
  $theme_version       = wp_get_theme( get_template() )->get( 'Version' );
  $frontend_stylesheet = get_template_directory_uri() . '/style.css';

  wp_enqueue_style( 'emma', $frontend_stylesheet, null, $theme_version );
}
add_action( 'enqueue_block_editor_assets', 'emma_enqueue_editor' );

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

function menu_output( $menu_array, $parent_menu_name ) {
  foreach( $menu_array as $menu_item ) {
    if ( str_starts_with( $menu_item['blockName'], 'core/navigation' ) ) { ?>
      <li>
        <?php if ( $menu_item['innerBlocks'] ) {?>
          <details>
            <summary><?= $menu_item['attrs']['label']; ?></summary>
            <div class="submenu menu-container">
              <div class="submenu__inner-container">
                <ul>
                  <li><button class="menu-back"><?= $parent_menu_name; ?></button></li>
                  <li class="top-level-menu-item"><a href="<?= $menu_item['attrs']['url'] ?>"><?= $menu_item['attrs']['label']; ?></a></li>
                  <?php menu_output( $menu_item['innerBlocks'], $menu_item['attrs']['label'] ); ?>
                </ul>
              </div>
            </div>
          </details>
        <?php } elseif ( ! str_contains( $menu_item['attrs']['className'] ?? '', 'flyout-menu-opener' ) ) { ?>
          <a href="<?= $menu_item['attrs']['url'] ?>"><?= $menu_item['attrs']['label']; ?></a>
        <?php } ?>
      </li>
    <?php }
  }
}

/**
 * Prevents posts set to noindex via Yoast SEO plugin from appearing in site search
 */
function emma_remove_noindex_from_wp_search( $query ) {
	if ( $query->is_search && ! is_admin() ) {
		$query->set( 'meta_query', array(
				'relation' => 'OR',
				array (
					'key' => '_yoast_wpseo_meta-robots-noindex',
					'value' => '1',
					'compare' => '!='
				),
				array(
					'key'     => '_yoast_wpseo_meta-robots-noindex',
					'compare' => 'NOT EXISTS',
				)
			)
 		);
	}
	return $query;
}
add_filter( 'pre_get_posts', 'emma_remove_noindex_from_wp_search' );
