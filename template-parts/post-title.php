<?php
if ( is_singular() || $post->ID == get_option('page_for_posts') ) :
  the_title( '<h1 class="entry-title">', '</h1>' );
else :
  the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
endif;
