<?php
if ( 'post' === get_post_type() ) { ?>
  <footer class="entry-footer">
    <div class="wrap">
      <?php
      /* translators: used between list items, there is a space after the comma */
      $categories_list = get_the_category_list( esc_html__( ', ', 'emma' ) );
      if ( $categories_list ) {
        /* translators: 1: list of categories. */
        printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'emma' ) . '</span>', $categories_list ); // WPCS: XSS OK.
      }

      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'emma' ) );
      if ( $tags_list ) {
        /* translators: 1: list of tags. */
        printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'emma' ) . '</span>', $tags_list ); // WPCS: XSS OK.
      }

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
      ?>
    </div><!-- .wrap -->
  </footer><!-- .entry-footer -->
<?php }
