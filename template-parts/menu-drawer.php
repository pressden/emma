<div class="flyout-menu-background menu-closer"></div>
<div id="flyout-menu" style="transform: translateX(100%);" class="flyout-menu <?php if ( is_active_sidebar( 'flyout-menu-content' ) ) { echo "two-column"; } ?>">
	<div class="flyout-menu-wrap">
		<div class="top-bar">
			<a href="#" id="menu-closer" class="menu-toggle menu-closer menu-closer-icon"><span class="screen-reader-text">Close Menu</span></a>
		</div>

		<div class="flyout-menu-left">
			<?php
				if ( is_active_sidebar( 'flyout-menu-before' ) ) {
					?>

					<section class="flyout-menu-before widget-area">
						<?php dynamic_sidebar( 'flyout-menu-before' ); ?>
					</section>

					<?php
				}
			?>

			<nav class="flyout-menu-menus">
				<ul class="menu">
					<li class="menu-back">
						<a href="#">Close Menu</a>
					</li>
				</ul>

				<div class="menu-clones">
					<div id="top-level-menus" class="top-level-menus">

						<?php
							$manual_menus = false;

							for( $tier = 1 ; $tier <= $GLOBALS['flyout_menu_tiers']; $tier++ ) {
								if ( has_nav_menu( 'flyout_menu_tier_' . $tier ) ) {	
									$manual_menus = true;				
									wp_nav_menu(
										array(
											'theme_location'  => 'flyout_menu_tier_' . $tier,
											'container' => false,
											'menu_class' => 'menu tier-' . $tier,
										)
									);				
								}				
							}
						?>

						<?php if( ! $manual_menus ) { ?>
							<?php // Menus placed here via Javascript (see: src/js/navigation.js). ?>
							<?php	for( $tier = 1 ; $tier <= $GLOBALS['flyout_menu_tiers']; $tier++ ) { ?>
								<ul class="menu auto-populate tier-<?php echo $tier; ?>"></ul>
							<?php }	?>
						<?php } ?>

					</div><!-- #menu-clones -->
				</div>
			</nav>

			<?php
				if ( is_active_sidebar( 'flyout-menu-after' ) ) {
					?>

					<section class="flyout-menu-after widget-area">
						<?php dynamic_sidebar( 'flyout-menu-after' ); ?>
					</section>

					<?php
				}
			?>
		</div>
		<?php
			if ( is_active_sidebar( 'flyout-menu-content' ) ) {
				?>

				<section class="flyout-menu-content widget-area">
					<?php dynamic_sidebar( 'flyout-menu-content' ); ?>
				</section>

				<?php
			}
		?>
	</div>
</div><!-- #flyout-menu -->
