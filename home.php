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
        $post = get_post( get_option( 'page_for_posts' ) );
        setup_postdata( $post );
        get_template_part( 'template-parts/content', get_post_format() );
        wp_reset_postdata();
      ?>

      <?php

      if ( have_posts() ) :
        ?>

        <div class="page-content">

          <?php
          /* Start the Loop */
          while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type() );
          endwhile;

          the_posts_navigation();
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
