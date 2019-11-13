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

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

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
 * Add Google Tag Manager script to header
 */
function emma_add_gtm_head_script() {
	$gtm_id = get_theme_mod( 'gtm_id', '' );
	if( $gtm_id != '' ) {
		?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','<?php echo $gtm_id; ?>');</script>
			<!-- End Google Tag Manager -->
		<?php
	}
}
add_filter( 'wp_head', 'emma_add_gtm_head_script', 1 );

/**
 * Add Google Tag Manager script to header
 */
function emma_add_gtm_body_scripts() {
	$gtm_id = get_theme_mod( 'gtm_id', '' );
	if( $gtm_id != '' ) {
		?>
			<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id; ?>"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php
	}
}
add_filter( 'emma_before', 'emma_add_gtm_body_scripts' );

/**
 * Custom classes metabox content
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
 * Add metabox for custom classes in all post types
 */
function emma_add_custom_classes_metabox() {
	add_meta_box( 'custom_classes', 'Custom Classes', 'emma_custom_classes_metabox_html', null, 'side' );
}
add_action('add_meta_boxes', 'emma_add_custom_classes_metabox');

/**
 * Save custom classes postdata
 */
function emma_save_custom_classes_postdata( $post_id ) {
	if( array_key_exists( 'custom_body_classes', $_POST ) ) {
		update_post_meta(
				$post_id,
				'custom_body_classes',
				$_POST['custom_body_classes']
		);
	}
}
add_action('save_post', 'emma_save_custom_classes_postdata');

/**
 * Add custom body classes to body tag
 */
function emma_output_custom_body_classes( $classes ) {
	global $post;
	$custom_classes = get_post_meta( $post->ID, 'custom_body_classes', true );

	if( ! empty( $custom_classes ) && $custom_classes != '' ) {
		$custom_classes_array = explode( " ", $custom_classes );
		return array_merge( $classes, $custom_classes_array );
	}
	return $classes;
}
add_filter( 'body_class', 'emma_output_custom_body_classes' );
