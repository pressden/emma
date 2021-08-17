<?php
/**
 * Helpers
 *
 * @package Emma
 */

if ( ! function_exists( 'emma_register_taxonomy' ) ) {
	/**
	 * Register taxonomy with preferred defaults
	 *
	 * @param string $codename Slug.
	 * @param string $singular Singular name.
	 * @param string $plural   Plural name.
	 * @param array  $args     Custom taxonomy arguments.
	 */
	function emma_register_taxonomy( $codename, $singular, $plural, $args = array() ) {
		$labels = array(
			'name'                       => $plural,
			'singular_name'              => $singular,
			'search_items'               => 'Search ' . $plural,
			'popular_items'              => 'Popular ' . $plural,
			'all_items'                  => 'All ' . $plural,
			'edit_item'                  => 'Edit ' . $singular,
			'update_item'                => 'Update ' . $singular,
			'add_new_item'               => 'Add New ' . $singular,
			'new_item_name'              => 'New ' . $singular . ' Name',
			'separate_items_with_commas' => 'Separate ' . strtolower( $plural ) . ' with commas',
			'add_or_remove_items'        => 'Add or remove ' . strtolower( $plural ),
			'choose_from_most_used'      => 'Choose from the most used ' . strtolower( $plural ),
			'menu_name'                  => $plural,
		);

		$defaults = array(
			'labels'       => $labels,
			'applies_to'   => array( 'post' ),
			'hierarchical' => true,
			'show_in_rest' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		register_taxonomy( $codename, $args['applies_to'], $args );
	}
}

if ( ! function_exists( 'emma_register_post_type' ) ) {
	/**
	 * Register post type with preferred defaults
	 *
	 * @param string $codename Slug.
	 * @param string $singular Singular name.
	 * @param string $plural   Plural name.
	 * @param array  $args     Custom post type arguments.
	 */
	function emma_register_post_type( $codename, $singular, $plural, $args = array() ) {
		$labels = array(
			'name'               => $plural,
			'singular_name'      => $singular,
			'add_new_item'       => 'Add New ' . $singular,
			'edit_item'          => 'Edit ' . $singular,
			'new_item'           => 'Create ' . $singular,
			'view_item'          => 'View ' . $singular,
			'search_items'       => 'Search ' . $singular,
			'not_found'          => 'No ' . strtolower( $plural ) . ' found',
			'not_found_in_trash' => 'No ' . strtolower( $plural ) . ' found in trash',
			'parent_item_colon'  => 'Parent ' . $singular . ':',
		);

		$defaults = array(
			'labels'          => $labels,
			'capability_type' => 'post',
			'supports'        => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
			'public'          => true,
			'menu_position'   => 20,
			'rewrite'         => array( 'slug' => $codename ),
			'has_archive'     => true,
			'show_in_rest'    => true,
		);

		$args = wp_parse_args( $args, $defaults );

		register_post_type( $codename, $args );
	}
}
