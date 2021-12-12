<?php if ( has_nav_menu( 'footer' ) ) : ?>

	<nav id="footer-navigation" class="site-navigation footer-navigation">
		<div class="menu-container">
			<ul id="footer-menu" class="menu">

				<?php
				/**
				 * Fires before the footer menu items.
				 *
				 * @since 1.0.0
				 */
				do_action( 'emma_before_footer_menu_items' );
				?>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => 'false',
						'items_wrap'     => '%3$s',
					)
				);
				?>

				<?php
				/**
				 * Fires after the footer menu items.
				 *
				 * @since 1.0.0
				 */
				do_action( 'emma_after_footer_menu_items' );
				?>

			</ul><!-- #footer-menu -->
		</div><!-- .menu-container -->
	</nav><!-- #footer-navigation -->

<?php endif; ?>
