<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<nav id="main-navigation" class="site-navigation main-navigation">
		<div class="wrap">
			<div class="menu-container">
				<ul id="primary-menu" class="menu">

					<?php
					/**
					 * Fires before the primary menu items.
					 *
					 * @since 1.0.0
					 */
					do_action( 'emma_before_primary_menu_items' );
					?>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => 'false',
							'items_wrap'     => '%3$s',
						)
					);
					?>

					<?php
					/**
					 * Fires after the primary menu items.
					 *
					 * @since 1.0.0
					 */
					do_action( 'emma_after_primary_menu_items' );
					?>

				</ul><!-- #primary-menu -->
			</div><!-- .menu-container -->
		</div><!-- .wrap -->
	</nav><!-- #main-navigation -->

<?php endif; ?>
