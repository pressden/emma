<?php
/**
 * The secondary sidebar widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emma
 */

if ( ! is_active_sidebar( 'secondary-sidebar' ) ) {
	return;
}
?>

<aside id="secondary-aside" class="widget-area secondary-widget-area">
	<?php dynamic_sidebar( 'secondary-sidebar' ); ?>
</aside><!-- #secondary-aside -->
