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
    $block_handles = apply_filters( 'emma_lazy_block_handles', array() );
    
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
    $lazy_handles = apply_filters( 'emma_lazy_block_handles', array() );
    
    // Early return if no handles are specified or current handle isn't in the list
    if ( empty( $lazy_handles ) || ! in_array( $handle, $lazy_handles, true ) ) {
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