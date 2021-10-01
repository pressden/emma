<div class="menu-container utility-menu">
	<ul class="menu">
		<?php if ( has_nav_menu( 'utility' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'utility',
					'menu_id'         => 'control-menu',
					'container'				=> 'false',
					'items_wrap'			=> '%3$s',
				)
			);
		} ?>

		<li class="menu-opener-container">
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
	</ul><!-- .navigation-controls -->
</div>
