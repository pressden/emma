<div class="site-branding">

	<?php
	/**
	 * Fires inside the site-branding markup.
	 *
	 * @since 1.0.0
	 */
	do_action( 'emma_site_branding' );
	?>

	<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

	<?php
	$emma_description = get_bloginfo( 'description', 'display' );

	if ( $emma_description || is_customize_preview() ) {
		?>

		<p class="site-description"><?php echo $emma_description; ?></p>

		<?php
	}
	?>

</div><!-- .site-branding -->
