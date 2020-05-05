<?php

/**
 * Enqueue backend scripts for stuff that should always get loaded
 */
function emma_load_block_editor_scripts() {
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
add_action( 'enqueue_block_editor_assets', 'emma_load_block_editor_scripts' );

/**
 * Register frontend scripts for conditional enqueueing
 */
function emma_register_conditional_frontend_scripts() {
  /**
   * Slider
   */
  $slider_js = get_template_directory_uri() . '/src/vendor/glide/glide.min.js';
  $slider_custom_js = get_template_directory_uri() . '/src/vendor/glide/glide-custom.js';
  $slider_core_css = get_template_directory_uri() . '/src/vendor/glide/glide.core.css';

  wp_register_script( 'slider', $slider_js, [] ); //slider library
  wp_register_script( 'slider-custom', $slider_custom_js, ['slider'] ); //our custom slider implementaton code
  wp_register_style( 'slider-core', $slider_core_css ); //slider core CSS
}
add_action( 'wp_enqueue_scripts', 'emma_register_conditional_frontend_scripts' );

/**
 * Conditionally enqueue frontend scripts for block based on whether the block is present
 */
function emma_conditional_block_enqueues() {
  global $post;

  /**
   * Slider Block
   */
  if( strpos( $post->post_content, 'emma/slider' ) ) {
    wp_enqueue_script( 'slider' ); //slider library
    wp_enqueue_script( 'slider-custom' ); //our custom slider implementaton code
    wp_enqueue_style( 'slider-core' ); //our custom slider block frontend CSS
  }
}
add_action( 'wp_head', 'emma_conditional_block_enqueues' );
