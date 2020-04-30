<?php

/**
 * Disable the emoji's
 * Code sourced from Disable Emojis plugin by Ryan Hellyer: https://wordpress.org/plugins/disable-emojis/
 * Implementation documentated by Kinsta: https://kinsta.com/knowledgebase/disable-emojis-wordpress/
 */
function emma_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'emma_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'emma_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'emma_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function emma_disable_emojis_tinymce( $plugins ) {
	$plugins = is_array( $plugins ) ? $plugins : array();
	return array_diff( $plugins, array( 'wpemoji' ) );
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function emma_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	// Bail early if not the correct relationship type.
	if ( 'dns-prefetch' !== $relation_type ) {
		return $urls;
	}

	/** This filter is documented in wp-includes/formatting.php */
	$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

	return array_diff( $urls, array( $emoji_svg_url ) );
}
