<?php

/**
 * Add menu meta box
 *
 * @param object $object The meta box object.
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
function emma_add_feature_link_meta_box( $object ) {
	add_meta_box(
		'feature-link-metabox',
		__( 'Feature Links', 'emma' ),
		'emma_feature_link_meta_box_content',
		'nav-menus',
		'side',
		'default'
	);
	return $object;
}
add_filter( 'nav_menu_meta_box_object', 'emma_add_feature_link_meta_box', 10, 1 );

/**
 * Displays a metabox for feature links menu item.
 *
 * @global int|string $nav_menu_selected_id (id, name or slug) of the currently-selected menu
 *
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/nav-menu.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-edit.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-checklist.php
 */
function emma_feature_link_meta_box_content() {
	global $nav_menu_selected_id;
	$walker = new Walker_Nav_Menu_Checklist();

	/**
	 * Feature Link Object
	 */
	class Feature {};

	$feature            = new Feature();
	$feature->classes   = array( 'search-form-toggle' );
	$feature->type      = 'custom';
	$feature->object_id = 'search-toggle';
	$feature->title     = 'Search';
	$feature->object    = 'custom';
	$feature->url       = '#';

	$features[] = $feature;

	if ( class_exists( 'WooCommerce' ) ) {
		$feature            = new Feature();
		$feature->classes   = array( 'mini-cart-toggle' );
		$feature->type      = 'custom';
		$feature->object_id = 'mini-cart-toggle';
		$feature->title     = 'Cart';
		$feature->object    = 'custom';
		$feature->url       = get_permalink( wc_get_page_id( 'cart' ) );

		$features[] = $feature;
	}

	/* set values to required item properties */
	?>

	<div id="feature-links" class="categorydiv">
		<div id="tabs-panel-feature-links-all" class="tabs-panel tabs-panel-view-all tabs-panel-active">
			<ul id="feature-links-checklist-all" class="categorychecklist form-no-clear">

			<?php
				echo walk_nav_menu_tree(
					array_map( 'wp_setup_nav_menu_item', $features ),
					0,
					(object) array( 'walker' => $walker )
				);
			?>

			</ul>
		</div><!-- /.tabs-panel -->

		<p class="button-controls wp-clearfix" data-items-type="feature-links" >
			<span class="list-controls hide-if-no-js">
				<input type="checkbox" id="feature-links-tab" class="select-all">
				<label for="feature-links-tab">Select All</label>
			</span>
			<span class="add-to-menu">
				<input
					type="submit"
					<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?>
					class="button-secondary submit-add-to-menu right"
					value="<?php esc_attr_e( 'Add to Menu', 'emma' ); ?>"
					name="add-feature-links-menu-item"
					id="submit-feature-links"
				/>
				<span class="spinner"></span>
			</span>
		</p>

	</div><!-- /.categorydiv -->

	<?php
}

/**
 * Modify menu metabox visibility
 *
 * @param integer $user_id User ID.
 */
function emma_change_menu_hidden_metaboxes( $user_id ) {
	$hidden_metaboxes = array();
	update_user_option( $user_id, 'metaboxhidden_nav-menus', $hidden_metaboxes );
}
add_action( 'user_register', 'emma_change_menu_hidden_metaboxes', 10, 1 );
