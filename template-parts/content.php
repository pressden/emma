<?php
/**
 * Template part for displaying content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php
  /**
   * Fires immediately before the entry-header opening markup.
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
   * Fires immediately after the entry-header closing markup.
   *
   * @since 1.0.0
   */
  do_action( 'emma_after_entry_header' );
  ?>

	<div class="entry-content">
		<?php
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
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
    <div class="wrap">
      <?php emma_entry_footer(); ?>
    </div><!-- .wrap -->
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
