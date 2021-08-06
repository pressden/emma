<?php
// Disable footer widgets by default.
$show_footer_widgets = false;

if ( 1 === $GLOBALS['emma_footer_widget_areas'] ) {
	if ( is_active_sidebar( 'footer-widgets' ) ) {
		?>

		<aside id="back-matter" class="footer-widgets">
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</aside>

		<?php
	}
} else {
	// Enable footer widgets if any of the widget areas are active.
	for ( $i = 1; $i <= $GLOBALS['emma_footer_widget_areas']; $i++ ) {
		if ( is_active_sidebar( 'footer-widgets-' . $i ) ) {
			$show_footer_widgets = true;
		}
	}

	// Conditionally render the footer widgets.
	if ( $show_footer_widgets ) {
		?>

		<aside id="back-matter" class="footer-widgets">
			<div class="wrap">

				<?php
				for ( $i = 1; $i <= $GLOBALS['emma_footer_widget_areas']; $i++ ) {
					if ( is_active_sidebar( 'footer-widgets-' . $i ) ) {
						?>

						<section class="footer-widgets-<?php echo esc_attr( $i ); ?> widget-area">
							<?php dynamic_sidebar( 'footer-widgets-' . $i ); ?>
						</section>

						<?php
					}
				}
				?>

			</div><!-- .wrap -->
		</aside><!-- #back-matter -->

		<?php
	}
}
