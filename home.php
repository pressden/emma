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
    if ( ! is_front_page() ) :
      ?>

      <header class="page-header">
        <h1 class="page-title"><?php single_post_title(); ?></h1>
      </header><!-- .page-header -->

      <?php
      if( has_post_thumbnail( get_option( 'page_for_posts', true ) ) ) :
        ?>

        <div class="page-thumbnail">
          <?php echo get_the_post_thumbnail( get_option( 'page_for_posts', true ) ); ?>
        </div><!-- .post-thumbnail .page-thumbnail -->

        <?php
      endif;
      ?>

      <?php
    endif;

    if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_sidebar( 'secondary' );
get_footer();
