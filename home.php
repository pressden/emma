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
		// Render the pfp if one exists.
		emma_render_page_for_posts( $post );

		// If there are posts to display, render them.
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
