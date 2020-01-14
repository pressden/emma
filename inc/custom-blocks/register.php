<?php

function load_block_editor_scripts() {
  wp_enqueue_script(
    'responsive-grid-block-js',
    get_template_directory_uri() . '/inc/custom-blocks/responsive-grid/responsive-grid-block.js',
    array( 'wp-blocks','wp-editor' ),
    true
  );
  wp_enqueue_style(
		'responsive-grid-block-css',
		get_template_directory_uri() . '/inc/custom-blocks/responsive-grid/responsive-grid-block.css',
    array(),
    filemtime( get_template_directory() . '/inc/custom-blocks/responsive-grid/responsive-grid-block.css' )
  );
}
add_action( 'enqueue_block_editor_assets', 'load_block_editor_scripts' );

$activate_flexslider = get_theme_mod( 'activate_flexslider', '' );
if( $activate_flexslider != '' ) {

  function load_flexslider_backend_scripts() {
    wp_enqueue_script(
      'flexslider-block-js',
      get_template_directory_uri() . '/inc/custom-blocks/flexslider/flexslider-block.js',
      array( 'wp-blocks','wp-editor' ),
      true
    );
    wp_enqueue_style(
      'flexslider-block-css',
      get_template_directory_uri() . '/inc/custom-blocks/flexslider/flexslider-block.css',
      array(),
      filemtime( get_template_directory() . '/inc/custom-blocks/flexslider/flexslider-block.css' )
    );
  }
  add_action( 'enqueue_block_editor_assets', 'load_flexslider_backend_scripts' );

  function load_flexslider_frontend_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'flexslider', get_stylesheet_directory_uri() . '/src/vendor/flexslider/jquery.flexslider-min.js', ['jquery'] );
    wp_enqueue_script( 'flexslider-frontend', get_stylesheet_directory_uri() . '/src/vendor/flexslider/flexslider-custom.js', ['flexslider'] );

    wp_enqueue_style( 'flexslider', get_stylesheet_directory_uri() . '/src/vendor/flexslider/flexslider.css' );
  }
  add_action( 'wp_enqueue_scripts', 'load_flexslider_frontend_scripts' );

}
