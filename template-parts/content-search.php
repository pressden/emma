<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>

	<header class="entry-header">
		<div class="wrap">

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<div class="entry-url"><a href="<?php echo get_permalink(); ?>"><?php echo get_permalink(); ?></a></div>

		</div><!-- .wrap -->
	</header><!-- .entry-header -->

	<?php emma_post_thumbnail( 'thumbnail' ); ?>

	<div class="entry-content">

		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
