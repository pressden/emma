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

		<div class="wp-site-blocks">
			<?php block_template_part( 'footer-content' ); ?>
		</div>
		
		<?php do_action( 'emma_site_info' ); ?>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php
/**
 * Fires before wp_footer() and the closing body tag.
 *
 * @since 1.0.0
 */
do_action( 'emma_after' );
?>

<?php wp_footer(); ?>

</body>
</html>
