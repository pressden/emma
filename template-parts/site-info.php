<div class="site-info">

	<div class="wrap">

		<span class="copyright-label">Copyright</span>

		<span class="copyright-symbol">&copy; <?php echo wp_kses_post( date( 'Y' ) ); ?></span>

		<a href="<?php echo esc_url( home_url() ); ?>" class="site-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>

		<span class="sep">|</span>

		<span class="copyright-rights"><?php esc_html_e( 'All rights reserved.', 'emma' ); ?></span>

	</div><!-- .wrap -->

</div><!-- .site-info -->
