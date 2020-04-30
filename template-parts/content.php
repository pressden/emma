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
	 * Fires before the entry-content markup.
	 *
	 * @since 1.0.0
	*/
	do_action( 'emma_before_entry_content' );
	?>

	<div class="entry-content">

		<?php
		/**
		 * Fires inside the entry-content markup.
		 *
		 * @since 1.0.0
		*/
		do_action( 'emma_entry_content' );
		?>

	</div><!-- .entry-content -->

	<?php
	/**
	 * Fires after the entry-content markup.
	 *
	 * @since 1.0.0
	*/
	do_action( 'emma_after_entry_content' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->
