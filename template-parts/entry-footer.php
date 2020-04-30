<?php if ( 'post' === get_post_type() ) { ?>

  <?php
  /**
   * Fires immediately before the entry-footer opening markup.
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
   * Fires immediately after the entry-footer closing markup.
   *
   * @since 1.0.0
   */
  do_action( 'emma_after_entry_footer' );
  ?>

<?php } ?>
