<?php if ( has_nav_menu( 'left' ) ) : ?>

	<nav id="left-navigation" class="site-navigation left-navigation">

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'left',
				'menu_id'         => 'left-menu',
				'container_class' => 'menu-container',
			)
		);
		?>

	</nav><!-- #left-navigation -->

<?php endif; ?>
