<?php
$post_layout = emma_get_layout_option( get_the_ID() );

switch( $post_layout ) {
  case 'content-sidebar':
  case 'sidebar-content':
    if( is_active_sidebar( 'primary-sidebar' ) ) {
      get_sidebar();
    }
  break;

  case 'sidebar-content-sidebar':
    if ( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) {
      get_sidebar();
      get_sidebar( 'secondary' );
    }
  break;

  default:
    // no sidebars
  break;
}
