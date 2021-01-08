<?php

/**
 * Enqueue backend scripts for stuff that should always get loaded
 */
function emma_enqueue_editor() {
  /**
   * Compiled JS
   */
  $emma_admin_js = get_stylesheet_directory_uri() . '/dist/admin.js';
  wp_enqueue_script( 'admin-js', $emma_admin_js, ['wp-blocks','wp-editor'], true );

  /**
   * Compiled SASS
   */
  $emma_admin_css = get_stylesheet_directory_uri() . '/dist/admin.css';
  wp_enqueue_style( 'emma-admin-css', $emma_admin_css );

}
add_action( 'enqueue_block_editor_assets', 'emma_enqueue_editor' );
