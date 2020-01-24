<?php

/**
 * Enqueue backend scripts for blocks that should always get loaded
 */
function emma_load_block_editor_scripts() {
  /**
   * Responsive Grid Block
   */
  $grid_block_js = get_template_directory_uri() . '/inc/custom-blocks/responsive-grid/responsive-grid-block.js';
  $grid_block_css = get_template_directory_uri() . '/inc/custom-blocks/responsive-grid/responsive-grid-block.css';
  $grid_block_css_file = get_template_directory() . '/inc/custom-blocks/responsive-grid/responsive-grid-block.css';

  wp_enqueue_script( 'responsive-grid-block-js', $grid_block_js, ['wp-blocks','wp-editor'], true ); //responsive grid block registration
  wp_enqueue_style( 'responsive-grid-block-css', $grid_block_css, [], filemtime( $grid_block_css_file ) ); //responsive grid block editor CSS

  /**
   * Slider Block
   */
  $slider_block_js = get_template_directory_uri() . '/inc/custom-blocks/slider/slider-block.js';
  $slider_block_css = get_template_directory_uri() . '/inc/custom-blocks/slider/slider-block.css';
  $slider_block_css_file = get_template_directory() . '/inc/custom-blocks/slider/slider-block.css';

  wp_enqueue_script( 'slider-block-js', $slider_block_js, ['wp-blocks','wp-editor'], true ); //slider block registration
  wp_enqueue_style( 'slider-block-css', $slider_block_css, [], filemtime( $slider_block_css_file ) ); //slider block editor CSS
}
add_action( 'enqueue_block_editor_assets', 'emma_load_block_editor_scripts' );

/**
 * Register frontend scripts for later enqueueing
 */
function emma_register_frontend_scripts() {
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
add_action( 'wp_enqueue_scripts', 'emma_register_frontend_scripts' );

/**
 * Conditionally enqueue frontend scripts for block based on whether the block is present
 */
function emma_conditional_block_enqueues() {
  global $post;

  /**
   * Slider Block
   */
  if( strpos( $post->post_content, 'emma/slider' ) ) {
    wp_enqueue_script( 'slider' ); //flexslider library
    wp_enqueue_script( 'slider-custom' ); //our custom flexslider implementaton code
    wp_enqueue_style( 'slider-core' ); //our custom flexslider block frontend CSS
    wp_enqueue_style( 'slider-theme' ); //our custom flexslider block frontend CSS
  }
}
add_action( 'wp_head', 'emma_conditional_block_enqueues' );
