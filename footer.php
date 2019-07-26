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

      <?php get_template_part( 'template-parts/site', 'info' ); ?>

    </div><!-- .wrap -->
	</footer><!-- #colophon -->
</div><!-- #page -->

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
