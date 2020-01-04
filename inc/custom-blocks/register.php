<?php

function load_responsive_grid_block() {
  wp_enqueue_script(
    'responsive-grid-block-js',
    get_template_directory_uri() . '/inc/custom-blocks/responsive-grid-block.js',
    array('wp-blocks','wp-editor'),
    true
  );
  wp_enqueue_style(
		'responsive-grid-block-css',
		get_template_directory_uri() . '/inc/custom-blocks/responsive-grid-block.css',
    array(),
    filemtime( get_template_directory() . '/inc/custom-blocks/responsive-grid-block.css' )
	);
}

add_action('enqueue_block_editor_assets', 'load_responsive_grid_block');
