<?php
/**
 * The home template file
 *
 * This is the template that displays all posts in a blog format.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		$post = get_post( get_option( 'page_for_posts' ) );
		setup_postdata( $post );

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

		wp_reset_postdata();
		?>

		<?php
		if ( have_posts() ) :
			?>

			<div class="page-content">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;

				emma_pagination();
				?>

			</div><!-- .page-content -->

			<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_template_part( 'template-parts/sidebars' );

get_footer();
