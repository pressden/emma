<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Emma
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<article id="404">
				<header class="entry-header">
					<div class="wrap">
						<h1 class="entry-title"><?php echo apply_filters( 'emma_404_page_title', "Oops! That page can't be found." ); ?></h1>
					</div><!-- .wrap -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p>
						<?php echo apply_filters( 'emma_404_page_content', "You can go back to our <a href='" . get_home_url() . "'>homepage</a> or search by topic below." ); ?>
					</p>

					<?php echo get_search_form(); ?>
				</div><!-- .entry-content -->

			</article><!-- #post-<?php the_ID(); ?> -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_template_part( 'template-parts/sidebars' );

get_footer();
