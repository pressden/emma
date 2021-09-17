<div class="site-branding">

	<?php
	/**
	 * Fires inside the site-branding markup.
	 *
	 * @since 1.0.0
	 * @package Emma
	 */

	do_action( 'emma_site_branding' );
	?>

	<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

	<?php
	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		?>

		<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>

		<?php
	}
	?>

</div><!-- .site-branding -->
