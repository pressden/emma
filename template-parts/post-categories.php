<?php
/* translators: used between list items, there is a space after the comma */
$categories_list = get_the_category_list( esc_html__( ', ', 'emma' ) );
if ( $categories_list ) {
  /* translators: 1: list of categories. */
  printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'emma' ) . '</span>', $categories_list ); // WPCS: XSS OK.
}
