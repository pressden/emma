<?php
/**
 * The template for displaying all WooCommerce pages
 *
 * This is the template that displays all WC pages. The main purpose of
 * the template is to ensure all WC pages are wrapped in markup that is
 * consistent with the rest of the theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_template_part( 'template-parts/sidebars' );

get_footer();
