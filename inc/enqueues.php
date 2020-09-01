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

/**
 * Register frontend scripts for conditional enqueueing
 */
function emma_enqueue_frontend() {
  /**
   * Slider
   */
  $slider_js = get_template_directory_uri() . '/src/vendor/glide/glide.min.js';
  $slider_version = '3.4.1';

  wp_enqueue_script( 'slider', $slider_js, [], $slider_version, true ); //slider library

  /**
   * Dialog Polyfill
   */
  $dialog_polyfill_js = get_template_directory_uri() . '/src/vendor/dialog-polyfill/dialog-polyfill.js';
  $dialog_polyfill_version = '0.5.2';

  wp_enqueue_script( 'dialog-polyfill', $dialog_polyfill_js, [], $dialog_polyfill_version, true );
}
add_action( 'wp_enqueue_scripts', 'emma_enqueue_frontend' );
