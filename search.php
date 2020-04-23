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

      <?php if ( have_posts() ) : ?>
        <header class="entry-header">
          <div class="wrap">
            <h1 class="entry-title">Search Results</h1>
          </div><!-- .wrap -->
        </header><!-- .entry-header -->

        <div class="entry-content">
          <?php echo get_search_form(); ?>

          <?php
          /* Start the Loop */
          while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', 'search' );
          endwhile;

          emma_pagination();
          ?>

        </div><!-- .entry-content -->

      <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_sidebar();
get_sidebar( 'secondary' );
get_footer();
