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
		<div class="page-content wp-site-blocks">
			<?php block_template_part( '404-content' ); ?>
		</div><!-- .page-content -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
