<?php
if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
  echo '<span class="comments-link">';
  comments_popup_link(
    sprintf(
      wp_kses(
        /* translators: %s: post title */
        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'emma' ),
        array(
          'span' => array(
            'class' => array(),
          ),
        )
      ),
      get_the_title()
    )
  );
  echo '</span>';
}
