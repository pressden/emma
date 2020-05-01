<?php
if( ( is_home() || is_archive() ) && get_theme_mod( 'archive_use_excerpts', false ) ) {
  the_excerpt();
}
else {
  the_content( sprintf(
    wp_kses(
      /* translators: %s: Name of current post. Only visible to screen readers */
      __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'emma' ),
      array(
        'span' => array(
          'class' => array(),
        ),
      )
    ),
    get_the_title()
  ) );

  wp_link_pages( array(
    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emma' ),
    'after'  => '</div>',
  ) );
}
