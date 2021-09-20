<nav id="menu-drawer" class="menu-drawer">
	<div class="navigation-controls">
		<a
			href="javascript:void(0);"
			id="menu-closer"
			class="menu-toggle menu-closer"
			title="<?php esc_attr_e( 'Close Primary Menu', 'emma' ); ?>"
		>
			<span class="screen-reader-text">Close Menu</span>
		</a>
	</div><!-- .navigation-controls -->

	<div class="menu-clones-container">
		<div id="menu-clones" class="menu-clones">
			<ul class="menu">
				<li class="menu-item menu-title main-menu-title"><a href="#" class="inactive" tab-index="-1" >Main Menu</a></li>
			</ul>

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
</nav><!-- #menu-drawer -->
