<?php if ( has_nav_menu( 'primary' ) ) : ?>

<nav id="main-navigation" class="site-navigation main-navigation">
	<div class="wrap">

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_id'         => 'primary-menu',
				'container_class' => 'menu-container',
			)
		);
		?>

	</div><!-- .wrap -->

</nav><!-- #main-navigation -->

<?php endif; ?>
