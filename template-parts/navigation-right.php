<?php if ( has_nav_menu( 'right' ) ) : ?>

	<nav id="right-navigation" class="site-navigation right-navigation">
		<div class="menu-container">
			<ul id="right-menu" class="menu">

				<?php
				/**
				 * Fires before the right menu items.
				 *
				 * @since 1.0.0
				 */
				do_action( 'emma_before_right_menu_items' );
				?>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'right',
						'container'      => 'false',
						'items_wrap'     => '%3$s',
					)
				);
				?>

				<?php
				/**
				 * Fires after the right menu items.
				 *
				 * @since 1.0.0
				 */
				do_action( 'emma_after_right_menu_items' );
				?>

			</ul><!-- #right-menu -->
		</div><!-- .menu-container -->
	</nav><!-- #right-navigation -->

<?php endif; ?>
