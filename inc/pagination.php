<?php

function emma_pagination() {

  if ( is_singular() ) {
    return;
  }

  global $wp_query;

  while( $wp_query->have_posts() )  : $wp_query->the_post();
  // Your code
  endwhile;

  $total_pages = $wp_query->max_num_pages;

  if ($total_pages > 1){

    $current_page = max(1, get_query_var('paged'));

    echo "<nav class='pagination'>";
    echo paginate_links( array(
      'base'                => @add_query_arg( 'paged','%#%' ),
      'format'              => '',
      'prev_text'           => __( '« prev' ),
      'next_text'           => __( 'next »' ),
      'type'                => 'list',
      'before_page_number'  => "<span class='screen-reader-text'>Page </span>",
    ) );
    echo "</nav>";
  }

}
