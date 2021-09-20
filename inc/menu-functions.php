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

function emma_menu_item_custom_fields( $item_id, $item ) {
	$menu_drawer_location = get_post_meta( $item_id, '_menu_drawer_location', true );
	wp_nonce_field( 'menu_item_nonce', '_menu_item_nonce_name' );

	if( $item->menu_item_parent == 0 ) {
	?>
	<div class="field-custom_menu_meta description-wide" style="margin: 5px 0;">
		<span class="description">Link placement in sliding menu</span>
		<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
		<div class="logged-input-holder">
			<?php echo $menu_drawer_location; ?>
			<select id="menu_drawer_location[<?php echo $item_id; ?>]" name="menu_drawer_location[<?php echo $item_id; ?>]">
				<option value="" <?php echo( $menu_drawer_location == "" ? "selected" : "" ); ?> />Default</option>
				<?php	for( $tier = 1 ; $tier <= $GLOBALS['menu_drawer_tiers']; $tier++ ) { ?>
					<option value="tier-<?php echo $tier; ?>" <?php echo( $menu_drawer_location == "tier-" . $tier ? "selected" : "" ); ?> />Tier <?php echo $tier; ?></option>
				<?php }	?>
				<option value="hide" <?php echo( $menu_drawer_location == "hide" ? "selected" : "" ); ?> /> Hide</option>
			</select>
		</div>
	</div>

	<div style="clear:both"><?php //var_dump( $item ); ?></div>
	<?php
	}
}
add_action( 'wp_nav_menu_item_custom_fields', 'emma_menu_item_custom_fields', 10, 2 );

function emma_menu_item_custom_fields_save( $menu_id, $menu_item_db_id ) {

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $_POST['_menu_item_nonce_name'] ) || ! wp_verify_nonce( $_POST['_menu_item_nonce_name'], 'menu_item_nonce' ) ) {
    return $menu_id;
	}

	$menu_drawer_location = $_POST['menu_drawer_location'][$menu_item_db_id];
	if ( isset( $menu_drawer_location) && "" != $menu_drawer_location ) {
		$sanitized_data = sanitize_text_field( $_POST['menu_drawer_location'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_menu_drawer_location', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_drawer_location' );
	}
}
add_action( 'wp_update_nav_menu_item', 'emma_menu_item_custom_fields_save', 10, 2 );

function emma_menu_item_class_output( $classes, $item ) {
	if( is_object( $item ) && isset( $item->ID ) ) {

		$feature_link_class = get_post_meta( $item->ID, '_feature_link', true );

		if ( ! empty( $feature_link_class ) ) {
			$classes[] = $feature_link_class;
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'emma_menu_item_class_output', 10, 2 );

function emma_menu_item_attributes_output( $attrs, $item, $args ) {
	if( is_object( $item ) && isset( $item->ID ) ) {
		$menu_drawer_location = get_post_meta( $item->ID, '_menu_drawer_location', true );

		if ( ! empty( $menu_drawer_location ) ) {
			$attrs['data-menu-drawer-location'] = $menu_drawer_location;
		}
		
	}
	return $attrs;
}
add_filter( 'nav_menu_link_attributes', 'emma_menu_item_attributes_output', 10, 3 );
