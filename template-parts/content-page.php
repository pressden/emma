<?php
/**
 * Template part for displaying page content in page.php
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
  ?>

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
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emma' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
