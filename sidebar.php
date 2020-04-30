<?php
/**
 * The primary sidebar widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emma
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}
?>

<aside id="primary-aside" class="widget-area primary-widget-area">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside><!-- #primary-aside -->
