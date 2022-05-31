<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Emma
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function emma_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds classes based on menu parameters
	$auto_add_toggle = get_theme_mod( 'auto_add_flyout_menu_toggle', true );

	if ( $auto_add_toggle ) {
		$classes[] = "has-auto-flyout-toggle";
	}

	if ( has_nav_menu( 'left' ) ) {
		$classes[] = "has-left-navigation";
	}

	if ( has_nav_menu( 'right' ) ) {
		$classes[] = "has-right-navigation";
	}

	// Add a layout body class.
	$post_layout = emma_get_layout_option( get_the_ID() );

	// Default layout.
	$default_layout = 'no-sidebar';

	// Check sidebar availability.
	switch ( $post_layout ) {
		case 'content-sidebar':
		case 'sidebar-content':
			if ( is_active_sidebar( 'primary-sidebar' ) ) {
				break;
			}
			// No break.

		case 'sidebar-content-sidebar':
			if ( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) {
				break;
			}
			// No break.

		default:
			$post_layout = $default_layout;
			break;
	}

	$classes[] = $post_layout;

	return $classes;
}
add_filter( 'body_class', 'emma_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function emma_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'emma_pingback_header' );

/**
 * Custom classes metabox content
 *
 * @param object $post Post object.
 */
function emma_custom_classes_metabox_html( $post ) {
	$body_classes = get_post_meta( $post->ID, 'custom_body_classes', true );
	?>

		<div class="components-base-control">
			<label for="custom_body_classes" class="components-base-control__label">Body Classes</label>
			<input class="components-text-control__input" type="text" name="custom_body_classes" value="<?php echo $body_classes; ?>"/>
		</div>

	<?php
}

/**
 * Add metabox for custom classes in supported post types
 */
function emma_add_custom_classes_metabox() {
	$context = 'custom_classes';

	$supported_post_types = array(
		'page',
		'post',
		'product',
	);

	$supported_post_types = apply_filters( 'emma_supported_post_types', $supported_post_types, $context );

	// Exit early if not a supported post type.
	if ( ! in_array( get_post_type(), $supported_post_types, true ) ) {
		return;
	}

	add_meta_box( 'custom_classes', 'Custom Classes', 'emma_custom_classes_metabox_html', null, 'side' );
}
add_action( 'add_meta_boxes', 'emma_add_custom_classes_metabox' );

/**
 * Save custom classes postdata
 *
 * @param integer $post_id Post ID.
 */
function emma_save_custom_classes_postdata( $post_id ) {
	if ( array_key_exists( 'custom_body_classes', $_POST ) ) {
		update_post_meta(
			$post_id,
			'custom_body_classes',
			$_POST['custom_body_classes']
		);
	}
}
add_action( 'save_post', 'emma_save_custom_classes_postdata' );

/**
 * Add custom body classes to body tag
 *
 * @param array $classes Array of body classes.
 */
function emma_output_custom_body_classes( $classes ) {
	global $post;
	if ( isset( $post->ID ) ) {
		$custom_classes = get_post_meta( $post->ID, 'custom_body_classes', true );

		if ( ! empty( $custom_classes ) && '' !== $custom_classes ) {
			$custom_classes_array = explode( ' ', $custom_classes );
			return array_merge( $classes, $custom_classes_array );
		}
	}
	return $classes;
}
add_filter( 'body_class', 'emma_output_custom_body_classes' );

/**
 * Layout options metabox content
 *
 * @param object $post Post object.
 * @param string $metabox Metabox location.
 */
function emma_layout_options_metabox_html( $post, $metabox ) {
	$hide_title  = get_post_meta( $post->ID, 'hide_title', true );
	$post_layout = get_post_meta( $post->ID, 'post_layout', true );

	wp_nonce_field( basename( __FILE__ ), 'layout_options_meta_box_nonce' );
	?>

	<div class="components-base-control">
		<div class="components-base-control__field">
			<span class="components-checkbox-control__input-container">
				<input id="hide-title-checkbox-control" name="hide_title" type="checkbox" <?php checked( $hide_title, 1 ); ?>>
			</span>
			<label class="components-checkbox-control__label" for="hide-title-checkbox-control">Hide Title</label>
		</div>
	</div>

	<div class="components-panel__row">
		<div class="components-base-control">
			<div class="components-base-control__field">
				<label class="components-base-control__label" for="post-layout-select-control">Select Layout: <?php echo $post_layout; ?></label>
				<?php // @TODO: The WP class `components-select-control__input` was removed due to horizontal overflow. Consider debugging. ?>
				<select name="post_layout" id="post-layout-select-control">
					<option value="">Default</option>
					<option value="no-sidebar" <?php selected( 'no-sidebar', $post_layout ); ?>>Content (no sidebar)</option>
					<option value="content-sidebar" <?php selected( 'content-sidebar', $post_layout ); ?>>Content + Sidebar</option>
					<option value="sidebar-content" <?php selected( 'sidebar-content', $post_layout ); ?>>Sidebar + Content</option>
					<option value="sidebar-content-sidebar" <?php selected( 'sidebar-content-sidebar', $post_layout ); ?>>Sidebar + Content + Sidebar</option>
				</select>
			</div>
		</div>
	</div>

	<?php
}

/**
 * Add metabox for layout options in supported post types
 */
function emma_add_layout_options_metabox() {
	$context = 'layout_options';

	$supported_post_types = array(
		'page',
		'post',
		'product',
	);

	$supported_post_types = apply_filters( 'emma_supported_post_types', $supported_post_types, $context );

	// Exit early if not a supported post type.
	if ( ! in_array( get_post_type(), $supported_post_types, true ) ) {
		return;
	}

	add_meta_box( 'layout_options', 'Layout Options', 'emma_layout_options_metabox_html', null, 'side' );
}
add_action( 'add_meta_boxes', 'emma_add_layout_options_metabox' );

/**
 * Save layout options postdata
 *
 * @param integer $post_id Post ID.
 */
function emma_save_layout_options_postdata( $post_id ) {
	if (
		empty( $_POST['layout_options_meta_box_nonce'] ) ||
		! wp_verify_nonce( $_POST['layout_options_meta_box_nonce'], basename( __FILE__ ) )
	) {
		return;
	}

	if ( array_key_exists( 'hide_title', $_POST ) ) {
		update_post_meta( $post_id, 'hide_title', 1 );
	} else {
		delete_post_meta( $post_id, 'hide_title' );
	}

	if ( isset( $_POST['post_layout'] ) && ! empty( $_POST['post_layout'] ) ) {
		update_post_meta( $post_id, 'post_layout', $_POST['post_layout'] );
	} else {
		delete_post_meta( $post_id, 'post_layout' );
	}
}
add_action( 'save_post', 'emma_save_layout_options_postdata' );

/**
 * Read more link.
 */
function emma_excerpt_readmore() {
	return '&hellip; <a href="' . esc_url( get_permalink() ) . '" class="more-link">Read More</a>';
}
add_filter( 'excerpt_more', 'emma_excerpt_readmore' );
