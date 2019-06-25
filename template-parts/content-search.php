<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

    <?php
    the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

    get_template_part( 'template-parts/entry', 'meta' );
    ?>

	</header><!-- .entry-header -->

	<?php emma_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
    <div class="wrap">
      <?php emma_entry_footer(); ?>
    </div><!-- .wrap -->
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
