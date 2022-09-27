<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="page-content wp-site-blocks">
			<?php
				$hide_title = get_post_meta( $post->ID, 'hide_title', true );
				if ( empty( $hide_title ) ) {
					echo do_blocks( '<!-- wp:post-title {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} /-->' );
				}
			?>
			<?php block_template_part( 'page-content' ); ?>
		</div><!-- .page-content -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
