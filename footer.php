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

	<footer id="colophon" class="site-footer">
    <div class="wrap">

      <?php
      /*
       * Include the site-info template in the footer.
       * If you want to override this in a child theme, then include a file
       * called site-info.php and that will be used instead.
       */
      get_template_part( 'template-parts/site', 'info' );
      ?>

    </div><!-- .wrap -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
