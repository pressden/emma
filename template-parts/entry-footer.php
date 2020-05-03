<?php
if( 'post' === get_post_type()
    && ( is_single() || ! get_theme_mod( 'archive_use_excerpts', false ) )
) {
  /**
   * Fires before the entry-footer markup.
   *
   * @since 1.0.0
   */
  do_action( 'emma_before_entry_footer' );
  ?>

  <footer class="entry-footer">
    <div class="wrap">

      <?php
      /**
       * Fires inside the entry-footer and wrap markup.
       *
       * @since 1.0.0
       */
      do_action( 'emma_entry_footer' );
      ?>

    </div><!-- .wrap -->
  </footer><!-- .entry-footer -->

  <?php
  /**
   * Fires after the entry-footer markup.
   *
   * @since 1.0.0
   */
  do_action( 'emma_after_entry_footer' );
}
