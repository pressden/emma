<?php
/**
 * Shortcodes
 *
 * @link https://developer.wordpress.org/plugins/shortcodes/
 *
 * @since 0.1
 */

function year_shortcode () {
    return date_i18n( 'Y' );
}
add_shortcode( 'year', 'year_shortcode' );

function site_name_shortcode () {
    return get_option( 'blogname' );
}
add_shortcode( 'site_name', 'site_name_shortcode' );
