<?php

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
