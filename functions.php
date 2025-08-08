<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @since 0.1
 */

require_once get_template_directory() . '/inc/enqueues.php';
require_once get_template_directory() . '/inc/shortcodes.php';
require_once get_template_directory() . '/inc/customizer.php';

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

/**
 * Disable WordPress emoji scripts and styles.
 */
function emma_disable_wp_emojis() {
  // Remove emoji scripts and styles from front-end and admin
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  // Remove from TinyMCE
  add_filter( 'tiny_mce_plugins', function( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    }
    return $plugins;
  } );
  // Remove DNS prefetch
  add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'emma_disable_wp_emojis' );
