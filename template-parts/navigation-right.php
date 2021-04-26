<?php if ( has_nav_menu( 'right' ) ) : ?>

	<nav id="right-navigation" class="site-navigation right-navigation">

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'right',
				'menu_id'         => 'right-menu',
				'container_class' => 'menu-container',
			)
		);
		?>

	</nav><!-- #right-navigation -->

<?php endif; ?>
