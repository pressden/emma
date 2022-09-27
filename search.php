<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Emma
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="page-content wp-site-blocks">
			<?php block_template_part( 'search-content' ); ?>
		</div><!-- .page-content -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_template_part( 'template-parts/sidebars' );

get_footer();
