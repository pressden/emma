<?php if ( has_nav_menu( 'footer' ) ) : ?>

<nav id="footer-navigation" class="site-navigation footer-navigation">

	<?php
	wp_nav_menu(
		array(
			'theme_location'  => 'footer',
			'menu_id'         => 'footer-menu',
			'container_class' => 'menu-container',
		)
	);
	?>

</nav><!-- #footer-navigation -->

<?php endif; ?>
