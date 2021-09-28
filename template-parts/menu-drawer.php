<nav id="menu-drawer" class="menu-drawer">
	<div class="top-bar">
		<a href="#" id="menu-closer" class="menu-toggle drawer-closer menu-closer"><span class="screen-reader-text">Close Menu</span></a>
	</div>

	<div class="menu-back">
		<a href="#">Close Menu</a>
	</div>

	<div class="menu-clones">
		<div id="top-level-menus" class="top-level-menus">

			<?php
				$manual_menus = false;

				for( $tier = 1 ; $tier <= $GLOBALS['menu_drawer_tiers']; $tier++ ) {
					if ( has_nav_menu( 'menu_drawer_tier_' . $tier ) ) {	
						$manual_menus = true;				
						wp_nav_menu(
							array(
								'theme_location'  => 'menu_drawer_tier_' . $tier,
								'container' => false,
								'menu_class' => 'menu tier-' . $tier,
							)
						);				
					}				
				}
			?>

			<?php if( ! $manual_menus ) { ?>
				<?php // Menus placed here via Javascript (see: src/js/navigation.js). ?>
				<?php	for( $tier = 1 ; $tier <= $GLOBALS['menu_drawer_tiers']; $tier++ ) { ?>
					<ul class="menu auto-populate tier-<?php echo $tier; ?>"></ul>
				<?php }	?>
			<?php } ?>

		</div><!-- #menu-clones -->
	</div>

	<?php
		for ( $i = 1; $i <= $GLOBALS['emma_menu_drawer_widget_areas']; $i++ ) {
			if ( is_active_sidebar( 'menu-drawer-widgets-' . $i ) ) {
				?>

				<section class="menu-drawer-widgets-<?php echo esc_attr( $i ); ?> widget-area">
					<?php dynamic_sidebar( 'menu-drawer-widgets-' . $i ); ?>
				</section>

				<?php
			}
		}
	?>
</nav><!-- #menu-drawer -->
