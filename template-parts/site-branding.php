<?php
/**
 * Site branding template part
 *
 * @package Emma
 */

?>

<div class="site-branding">

	<?php
	/**
	 * Fires inside the site-branding markup.
	 *
	 * @since 1.0.0
	 */

	do_action( 'emma_site_branding' );
	?>

	<p class="site-title">
		<?php if ( display_header_text() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php endif; ?>
			<?php bloginfo( 'name' ); ?>
		<?php if ( display_header_text() ) : ?>
			</a>
		<?php endif; ?>
	</p>

	<?php
	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		?>

		<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>

		<?php
	}
	?>

</div><!-- .site-branding -->
