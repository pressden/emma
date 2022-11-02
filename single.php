<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					echo do_blocks( '<!-- wp:post-title {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"className":"page-title"} /-->' );
				}
			?>
			<?php block_template_part( 'single-content' ); ?>
		</div><!-- .page-content -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
