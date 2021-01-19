<?php

function emma_pagination() {
  the_posts_pagination( array(
    'mid_size'  => 2,
    'prev_text' => __( '<span class="screen-reader-text">previous</span>', 'emma' ),
    'next_text' => __( '<span class="screen-reader-text">next</span>', 'emma' ),
  ) );
}
