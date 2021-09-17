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

			<ul class="menu tier-1"></ul>
			<ul class="menu tier-2"></ul>

			<?php // Menus placed here via Javascript (see: src/js/navigation.js). ?>

		</div><!-- #menu-clones -->
	</div>
</nav><!-- #menu-drawer -->
