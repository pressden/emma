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

  <?php
  /**
   * Fires before the footer element markup.
   *
   * @since 1.0.0
   */
  do_action( 'emma_before_footer' );
  ?>

	<footer id="colophon" class="site-footer">
    <div class="wrap">

      <?php
      /**
       * Fires inside the footer element and wrap markup.
       *
       * @since 1.0.0
      */
      do_action( 'emma_footer' );
      ?>

    </div><!-- .wrap -->
  </footer><!-- #colophon -->

  <?php
  /**
   * Fires after the footer element markup.
   *
   * @since 1.0.0
   */
  do_action( 'emma_after_footer' );
  ?>

</div><!-- #page -->

<?php
/**
 * Fires before wp_footer() and the closing body tag.
 *
 * @since 1.0.0
 */
do_action( 'emma_after' );

wp_footer();
?>

</body>
</html>
