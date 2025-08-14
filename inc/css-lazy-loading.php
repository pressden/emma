<?php
/**
 * Filter the array of block handles that should be lazy loaded and prevented from inlining. Useful for blocks that will always be below-the-fold (e.g. the Social Icons block when only ever located in the footer).
 *
 * @since 2.5
 * 
 * @param array $handles Array of block CSS handles to lazy load
 */

/**
 * Prevent WordPress from inlining CSS for specified block handles
 * by removing the 'path' from the style's extra data.
 * This forces WordPress to always load them as separate stylesheets.
 */
function emma_prevent_block_css_inlining() {
  $block_handles = apply_filters( 'emma_lazy_load_block_handles', array() );
  
  // Early return if no handles are specified
  if ( empty( $block_handles ) ) {
    return;
  }
  
  foreach ( $block_handles as $handle ) {
    // Get the registered style object
    $style = wp_styles()->query( $handle, 'registered' );
    if ( ! $style ) {
      continue;
    }
    
    // Remove the 'path' property to prevent inlining
    // WordPress checks for this path to determine if it should inline the CSS
    unset( $style->extra['path'] );
    
    // The CSS will now always be loaded as a <link> tag regardless of size
    // and regardless of your styles_inline_size_limit setting
  }
}
add_action( 'wp_enqueue_scripts', 'emma_prevent_block_css_inlining', PHP_INT_MAX );

/**
 * Lazy load CSS for configured block handles
 */
function emma_lazy_load_block_css( $html, $handle, $href, $media ) {
  $lazy_handles = apply_filters( 'emma_lazy_load_css_handles', array() );
  $block_handles = apply_filters( 'emma_lazy_load_block_handles', array() );
  
  // Merge both arrays to get all handles that should be lazy loaded
  $all_lazy_handles = array_merge( $lazy_handles, $block_handles );
  
  // Early return if no handles are specified or current handle isn't in the list
  if ( empty( $all_lazy_handles ) || ! in_array( $handle, $all_lazy_handles, true ) ) {
    return $html;
  }
  
  // Replace the media attribute and add onload for lazy loading
  $html = str_replace(
    "media='all'",
    "media='print' onload=\"this.media='all'; this.onload=null;\"",
    $html
  );
    
  // Fallback if media attribute is different or missing
  if ( strpos( $html, "onload=" ) === false ) {
    $html = str_replace(
      ' />',
      " media='print' onload=\"this.media='all'; this.onload=null;\" />",
    $html
    );
  }
  
  return $html;
}
add_filter( 'style_loader_tag', 'emma_lazy_load_block_css', 10, 4 );

/**
 * Get the contents of an enqueued stylesheet
 *
 * @param string $handle The handle of the stylesheet to get the contents of
 * @return string|false The contents of the stylesheet or false if it doesn't exist
 */
function emma_get_enqueued_stylesheet_contents( $handle ) {
  global $wp_styles;
  
  // Check if the style is registered
  if ( !isset($wp_styles->registered[$handle] ) ) {
      return false;
  }
  
  $style = $wp_styles->registered[$handle];
  $src = $style->src;
  
  // Convert URL to file path
  if ( strpos( $src, home_url() ) === 0 ) {
    $relative_path = str_replace( home_url(), '', $src );
    $file_path = ABSPATH . ltrim( $relative_path, '/' );
    
    if ( file_exists( $file_path ) ) {
      return file_get_contents( $file_path );
    }
  }
  
  return false;
}

/**
 * Lazy load a stylesheet
 *
 * @param string $handle The handle of the stylesheet to lazy load
 */
function emma_lazy_load_stylesheet( $handle ) {
  add_filter( 'emma_lazy_load_css_handles', function( $lazy_handles ) use ( $handle ) {
    return array_merge( $lazy_handles, array( $handle ) );
  }, 10, 1 );
}

/**
 * Lazy load and inline a stylesheet
 *
 * @param string $handle The handle of the stylesheet to lazy load and inline
 */
function emma_lazy_load_and_inline_stylesheet( $handle ) {
  $contents = emma_get_enqueued_stylesheet_contents( $handle );
  if ( $contents ) {
    wp_add_inline_style( $handle, $contents );
  }
  emma_lazy_load_stylesheet( $handle );
}
add_action( 'wp_enqueue_scripts', 'emma_lazy_load_and_inline_stylesheet', 10, 1 );