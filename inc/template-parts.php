<?php
/**
 * Functions which load template parts by hooking into Emma actions
 *
 * @package Emma
 */

/**
 * Gets the footer widgets template part.
 */
function emma_footer_widgets_template() {
  get_template_part( 'template-parts/footer', 'widgets' );
}
add_action( 'emma_before_footer', 'emma_footer_widgets_template' );

/**
 * Gets the menu drawer template part.
 */
function emma_menu_drawer_template() {
  get_template_part( 'template-parts/menu', 'drawer' );
}
add_action( 'emma_after', 'emma_menu_drawer_template' );

/**
 * Gets the mini cart template part.
 */
function emma_mini_cart_template() {
  get_template_part( 'template-parts/mini-cart' );
}
if ( class_exists( 'WooCommerce' ) ) {
  add_action( 'emma_after', 'emma_mini_cart_template' );
}

/**
 * Output search form on all pages with a class that hides it
 */
function emma_search_form() {
  get_template_part( 'template-parts/toggle-search-form' );
}
add_action( 'emma_after', 'emma_search_form' );
