<?php
/* translators: used between list items, there is a space after the comma */
$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'emma' ) );
if ( $tags_list ) {
  /* translators: 1: list of tags. */
  printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'emma' ) . '</span>', $tags_list ); // WPCS: XSS OK.
}
