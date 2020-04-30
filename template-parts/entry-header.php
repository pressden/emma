<?php
/**
 * Fires immediately before the entry-header markup.
 *
 * @since 1.0.0
 */
do_action( 'emma_before_entry_header' );

$hide_title = get_post_meta( $post->ID, 'hide_title', true );
if( empty( $hide_title ) ) { ?>

  <header class="entry-header">
    <div class="wrap">

      <?php
      /**
       * Fires inside the entry-header and wrap markup.
       *
       * @since 1.0.0
      */
      do_action( 'emma_entry_header' );
      ?>

    </div><!-- .wrap -->
  </header><!-- .entry-header -->

<?php } ?>

<?php
/**
 * Fires immediately after the entry-header markup.
 *
 * @since 1.0.0
 */
do_action( 'emma_after_entry_header' );
?>
