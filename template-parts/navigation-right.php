<?php $desktop_show_flyout_menu_toggle = get_theme_mod( 'desktop_show_flyout_menu_toggle', false ); ?>
<nav id="right-navigation" class="site-navigation right-navigation">
	<div class="menu-container">
		<ul id="right-menu" class="menu">
			<?php if ( has_nav_menu( 'right' ) ) {
				wp_nav_menu(
					array(
						'theme_location'  => 'right',
						'container'				=> 'false',
						'items_wrap'			=> '%3$s',
					)
				);
			} ?>

			<li class="menu-opener-container <?php echo ! $desktop_show_flyout_menu_toggle ? 'hide-on-desktop' : ''; ?>">
				<a
					href="#"
					id="menu-opener"
					class="menu-toggle menu-opener"
					aria-controls="flyout-menu"
					aria-expanded="false"
					title="<?php esc_attr_e( 'Primary Menu', 'emma' ); ?>"
				>
					<span class="screen-reader-text">Open Menu</span>
				</a>
			</li>
		</ul>
	</div>
</nav>
