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
