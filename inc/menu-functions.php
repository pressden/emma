<?php
/**
 * Buffer the output of a template part for use elsewhere
 */
function emma_buffer_template_part( $slug = '', $name ='' ) {
	ob_start();
	get_template_part( $slug, $name );
	return ob_get_clean();
}

/**
 * Add the flyout menu opener link to right menu, if menu is set
 */
function emma_add_menu_opener_menu_item( $items, $args ){
	$auto_add_toggle = get_theme_mod( 'auto_add_flyout_menu_toggle' );
	if( $auto_add_toggle ) {
		if( $args->theme_location == 'right' ){
			$items .= emma_buffer_template_part( 'template-parts/flyout-menu', 'opener' );
		}
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'emma_add_menu_opener_menu_item', 10, 2);

/**
 * Fallback function to add the right menu if it is not set
 */
function fallback_right_menu() {
	ob_start(); ?>
		<div class="menu-container">
			<ul id="right-menu" class="menu">
				<?php get_template_part( 'template-parts/flyout-menu', 'opener' ); ?>
			</ul>
		</div>
	<?php	echo ob_get_clean();
}

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
	$feature->classes   = array( 'flyout-menu-opener' );
	$feature->type      = 'custom';
	$feature->object_id = 'flyout-menu-opener';
	$feature->title     = 'Open Menu';
	$feature->object    = 'custom';
	$feature->url       = '#';

	$features[] = $feature;

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

/**
 * Add menu item custom fields
 *
 * @param integer $item_id Menu item ID.
 * @param object  $item    Menu item object.
 */
function emma_menu_item_custom_fields( $item_id, $item ) {
	$flyout_menu_location = get_post_meta( $item_id, '_flyout_menu_location', true );

	wp_nonce_field( 'menu_item_nonce', '_menu_item_nonce_name' );

	if ( 0 === intval( $item->menu_item_parent ) ) {
		?>

		<div class="field-custom_menu_meta description-wide" style="margin: 5px 0;">
			<span class="description">Link placement in sliding menu</span>
			<input type="hidden" class="nav-menu-id" value="<?php echo esc_attr( $item_id ); ?>" />
			<div class="logged-input-holder">

				<?php echo wp_kses_post( $flyout_menu_location ); ?>

				<select id="flyout_menu_location[<?php echo esc_attr( $item_id ); ?>]" name="flyout_menu_location[<?php echo esc_attr( $item_id ); ?>]">
					<option value="" <?php echo ( '' === $flyout_menu_location ) ? 'selected' : ''; ?>>Default</option>

					<?php
					for ( $i = 1; $i <= $GLOBALS['flyout_menu_tiers']; $i++ ) {
						?>

						<option value="tier-<?php echo intval( $i ); ?>" <?php echo ( 'tier-' . $i === $flyout_menu_location ) ? 'selected' : ''; ?>>
							Tier <?php echo intval( $i ); ?>
						</option>

						<?php
					}
					?>

					<option value="hide" <?php echo( 'hide' === $flyout_menu_location ) ? 'selected' : ''; ?>> Hide</option>
				</select>
			</div>
		</div>

		<div style="clear:both"></div>

		<?php
	}
}
add_action( 'wp_nav_menu_item_custom_fields', 'emma_menu_item_custom_fields', 10, 2 );

/**
 * Save menu item custom fields
 *
 * @param integer $menu_id         Menu item ID.
 * @param integer $menu_item_db_id Menu item database ID.
 */
function emma_menu_item_custom_fields_save( $menu_id, $menu_item_db_id ) {
	// Get the sanitized and unslashed nonce.
	$nonce = ( isset( $_POST['_menu_item_nonce_name'] ) ) ? sanitize_key( wp_unslash( $_POST['_menu_item_nonce_name'] ) ) : null;

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $nonce ) || ! wp_verify_nonce( $nonce, 'menu_item_nonce' ) ) {
		return $menu_id;
	}

	$flyout_menu_location = ( isset( $_POST['flyout_menu_location'][ $menu_item_db_id ] ) ) ? sanitize_key( wp_unslash( $_POST['flyout_menu_location'][ $menu_item_db_id ] ) ) : null;

	if ( isset( $flyout_menu_location ) && '' !== $flyout_menu_location ) {
		update_post_meta( $menu_item_db_id, '_flyout_menu_location', $flyout_menu_location );
	} else {
		delete_post_meta( $menu_item_db_id, '_flyout_menu_location' );
	}
}
add_action( 'wp_update_nav_menu_item', 'emma_menu_item_custom_fields_save', 10, 2 );

/**
 * Filter menu classes
 *
 * @param array  $classes Array of menu classes.
 * @param object $item    Menu item object.
 */
function emma_menu_item_class_output( $classes, $item ) {
	if ( is_object( $item ) && isset( $item->ID ) ) {

		$feature_link_class = get_post_meta( $item->ID, '_feature_link', true );

		if ( ! empty( $feature_link_class ) ) {
			$classes[] = $feature_link_class;
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'emma_menu_item_class_output', 10, 2 );

/**
 * Filter menu item output
 *
 * @param array  $attrs Menu item attributes.
 * @param object $item  Menu item object.
 * @param array  $args  Filter arguments.
 */
function emma_menu_item_attributes_output( $attrs, $item, $args ) {
	if ( is_object( $item ) && isset( $item->ID ) ) {
		$flyout_menu_location = get_post_meta( $item->ID, '_flyout_menu_location', true );

		if ( ! empty( $flyout_menu_location ) ) {
			$attrs['data-flyout-menu-location'] = $flyout_menu_location;
		}
	}

	$item_has_children = in_array( 'menu-item-has-children', $item->classes, true );
	if ( $item_has_children ) {
		$attrs['aria-haspopup']    = true;
		$attrs['aria-expanded']    = false;
		$attrs['data-sub-menu-id'] = $item->ID;
	}

	return $attrs;
}
add_filter( 'nav_menu_link_attributes', 'emma_menu_item_attributes_output', 10, 3 );
