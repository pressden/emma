<?php 
	$auto_add_toggle = get_theme_mod( 'auto_add_flyout_menu_toggle', true );
	if ( has_nav_menu( 'right' ) || $auto_add_toggle ) : 
?>

<nav id="right-navigation" class="site-navigation right-navigation">

	<?php
	wp_nav_menu(
		array(
			'theme_location'  => 'right',
			'menu_id'         => 'right-menu',
			'container_class' => 'menu-container',
			'fallback_cb'			=> 'fallback_right_menu',
		)
	);
	?>

</nav><!-- #right-navigation -->

<?php endif; ?>
