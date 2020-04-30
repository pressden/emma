<?php
/**
 * Functions which load template parts by hooking into Emma actions
 *
 * @package Emma
 */

/**
 * Gets the post thumbnail template part.
 */
function emma_post_thumbnail_template() {
  get_template_part( 'template-parts/post', 'thumbnail' );
}
add_action( 'emma_after_entry_header', 'emma_post_thumbnail_template' );

/**
 * Gets the entry header template part.
 */
function emma_entry_header_template() {
  get_template_part( 'template-parts/entry', 'header' );
}
add_action( 'emma_before_entry_content', 'emma_entry_header_template' );

/**
 * Gets the entry header inner template part.
 */
function emma_entry_header_inner_template() {
  get_template_part( 'template-parts/post', 'title' );
  get_template_part( 'template-parts/entry', 'meta' );
}
add_action( 'emma_entry_header', 'emma_entry_header_inner_template' );

/**
 * Gets the entry content template part.
 */
function emma_entry_content_template() {
  get_template_part( 'template-parts/entry', 'content' );
}
add_action( 'emma_entry_content', 'emma_entry_content_template' );

/**
 * Gets the entry footer template part.
 */
function emma_entry_footer_template() {
  get_template_part( 'template-parts/entry', 'footer' );
}
add_action( 'emma_after_entry_content', 'emma_entry_footer_template' );

/**
 * Gets the entry footer inner template part.
 */
function emma_entry_footer_inner_template() {
  get_template_part( 'template-parts/post', 'categories' );
  get_template_part( 'template-parts/post', 'tags' );
  get_template_part( 'template-parts/post', 'comments' );
}
add_action( 'emma_entry_footer', 'emma_entry_footer_inner_template' );

 /**
 * Gets the footer widgets template part.
 */
function emma_footer_widgets_template() {
  get_template_part( 'template-parts/footer', 'widgets' );
}
add_action( 'emma_before_footer', 'emma_footer_widgets_template' );

/**
 * Gets the footer menu template part.
 */
function emma_footer_menu_template() {
  get_template_part( 'template-parts/footer', 'menu' );
}
add_action( 'emma_footer', 'emma_footer_menu_template' );

/**
 * Gets the site info template part.
 */
function emma_site_info_template() {
  get_template_part( 'template-parts/site', 'info' );
}
add_action( 'emma_footer', 'emma_site_info_template' );

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
