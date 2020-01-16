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
   * Flexslider Block
   */
  $flexslider_block_js = get_template_directory_uri() . '/inc/custom-blocks/flexslider/flexslider-block.js';
  $flexslider_block_css = get_template_directory_uri() . '/inc/custom-blocks/flexslider/flexslider-block.css';
  $flexslider_block_css_file = get_template_directory() . '/inc/custom-blocks/flexslider/flexslider-block.css';

  wp_enqueue_script( 'flexslider-block-js', $flexslider_block_js, ['wp-blocks','wp-editor'], true ); //flexslider block registration
  wp_enqueue_style( 'flexslider-block-css', $flexslider_block_css, [], filemtime( $flexslider_block_css_file ) ); //flexslider block editor CSS
}
add_action( 'enqueue_block_editor_assets', 'emma_load_block_editor_scripts' );

/**
 * Register frontend scripts for later enqueueing
 */
function emma_register_frontend_scripts() {
  $flexslider_js = get_template_directory_uri() . '/src/vendor/flexslider/jquery.flexslider-min.js';
  $flexslider_block_js = get_template_directory_uri() . '/src/vendor/flexslider/flexslider-custom.js';
  $flexslider_block_css = get_template_directory_uri() . '/src/vendor/flexslider/flexslider.css';

  wp_register_script( 'flexslider', $flexslider_js, ['jquery'] ); //flexslider library
  wp_register_script( 'flexslider-custom', $flexslider_block_js, ['flexslider'] ); //our custom flexslider implementaton code
  wp_register_style( 'flexslider', $flexslider_block_css ); //our custom flexslider block frontend CSS
}
add_action( 'wp_enqueue_scripts', 'emma_register_frontend_scripts' );

/**
 * Conditionally enqueue frontend scripts for block based on whether the block is present
 */
function emma_conditional_block_enqueues() {
  global $post;

  /**
   * Flexslider Block
   */
  if( strpos( $post->post_content, 'emma/flexslider' ) ) {
    wp_enqueue_script( 'jquery' ); //jQuery
    wp_enqueue_script( 'flexslider' ); //flexslider library
    wp_enqueue_script( 'flexslider-custom' ); //our custom flexslider implementaton code
    wp_enqueue_style( 'flexslider' ); //our custom flexslider block frontend CSS
  }
}
add_action( 'wp_head', 'emma_conditional_block_enqueues' );
