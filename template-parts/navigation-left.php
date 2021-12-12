<?php if ( has_nav_menu( 'left' ) ) : ?>

	<nav id="left-navigation" class="site-navigation left-navigation">
		<div class="menu-container">
			<ul id="left-menu" class="menu">

				<?php
				/**
				 * Fires before the left menu items.
				 *
				 * @since 1.0.0
				 */
				do_action( 'emma_before_left_menu_items' );
				?>

				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'left',
						'container'      => 'false',
						'items_wrap'     => '%3$s',
					)
				);
				?>

				<?php
				/**
				 * Fires after the left menu items.
				 *
				 * @since 1.0.0
				 */
				do_action( 'emma_after_left_menu_items' );
				?>

			</ul><!-- #left-menu -->
		</div><!-- .menu-container -->
	</nav><!-- #left-navigation -->

<?php endif; ?>
