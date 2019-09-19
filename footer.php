<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emma
 */

?>

	</div><!-- #content -->

  <?php get_template_part( 'template-parts/footer', 'widgets' ); ?>

	<footer id="colophon" class="site-footer">
    <div class="wrap">

      <?php if ( has_nav_menu( 'footer' ) ) : ?>
        <nav id="footer-navigation" class="site-navigation footer-navigation">
          <?php
          wp_nav_menu( array(
            'theme_location'  => 'footer',
            'menu_id'         => 'footer-menu',
            'container_class' => 'menu-container',
          ) );
          ?>
        </nav><!-- #footer-navigation -->
      <?php endif; ?>

      <?php get_template_part( 'template-parts/site', 'info' ); ?>

    </div><!-- .wrap -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php get_template_part( 'template-parts/menu', 'drawer' ); ?>

<?php
/**
 * Fires immediately before wp_footer(), after the site container closing markup.
 *
 * @since 1.0.0
 */
do_action( 'emma_after' );

wp_footer();
?>

</body>
</html>
