<?php

/**
 * Enqueue backend scripts for stuff that should always get loaded
 */
function emma_enqueue_editor() {
	/**
	 * Compiled JS
	 */
	$emma_admin_js = get_stylesheet_directory_uri() . '/dist/admin.js';
	wp_enqueue_script(
		'emma-admin',
		$emma_admin_js,
		array( 'wp-blocks', 'wp-editor' ),
		wp_get_theme()->get( 'Version' ),
		true
	);

	/**
	 * Compiled SASS
	 */
	$emma_admin_css = get_stylesheet_directory_uri() . '/dist/admin.css';
	wp_enqueue_style(
		'emma-admin',
		$emma_admin_css,
		null,
		wp_get_theme()->get( 'Version' )
	);

}
add_action( 'admin_enqueue_scripts', 'emma_enqueue_editor' );
