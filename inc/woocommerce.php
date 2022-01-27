<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Emma
 */

/**
 * Hooks to run if WooCommerce is installed and active
 *
 * This code confirms the presence of the WooCommerce class before manupulating
 * any WC specific action or filter hooks. If WC is not available all execution
 * of this file is skipped.
 */
if ( class_exists( 'WooCommerce' ) ) {
	// Dequeue default woocommerce styles.
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

	// Declare theme and product-gallery support.
	add_action( 'after_setup_theme', 'emma_declare_woocommerce_support' );

	add_action( 'woocommerce_before_main_content', 'emma_add_product_page_featured_image', 10, 2 );

	// This happens right before the note of how many products are shown on the shop page.
	add_action( 'woocommerce_before_shop_loop', 'emma_add_product_sorting_open_div', 19 );

	// This happens between the results count and the sorting method.
	add_action( 'woocommerce_before_shop_loop', 'emma_add_product_sorting_column_sizer', 25 );

	// This happens right after the sorting form on the shop page.
	add_action( 'woocommerce_before_shop_loop', 'emma_add_close_div', 31 );

	// Enqueue custom WooCommerce scripts.
	add_action( 'wp_enqueue_scripts', 'emma_enqueue_woocommerce_scripts' );

	// Filter shop columns.
	add_filter( 'loop_shop_columns', 'emma_product_columns' );

	// Move related products outside of single product details wrapper.
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

	// Filter the related products columns argument.
	add_filter( 'woocommerce_output_related_products_args', 'emma_related_product_columns', 20 );

	// Filter products per page.
	add_filter( 'loop_shop_per_page', 'emma_products_per_page', 20 );

	// Add custom markup to the add to cart fragments.
	add_filter( 'woocommerce_add_to_cart_fragments', 'emma_cart_anchor_fragment' );

	// Filter title visibility on Woocommerce pages.
	add_filter( 'woocommerce_show_page_title', 'emma_woocommerce_show_page_title' );

	remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
	add_action( 'woocommerce_after_shop_loop', 'emma_pagination', 10);
}

/**
 * Declare WooCommerce theme support.
 */
function emma_declare_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Enqueue Woocommerce scripts and styles.
 */
function emma_enqueue_woocommerce_scripts() {
	wp_enqueue_script( 'emma-woocommerce-scripts', get_stylesheet_directory_uri() . '/dist/woocommerce.js', null, wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_style( 'emma-woocommerce-style', get_stylesheet_directory_uri() . '/dist/woocommerce.css', null, wp_get_theme()->get( 'Version' ) );
}

/**
 * Add support for the Emma title toggle on WooCommerce pages
 *
 * @param bool $show_title Boolean flag to indicate title visibility.
 */
function emma_woocommerce_show_page_title( $show_title ) {
	// Exit early if not the main shop page.
	if ( is_search() || is_tax() ) {
		return $show_title;
	}

	// Get the shop page as a post object.
	$post = get_post( get_option( 'woocommerce_shop_page_id' ) );

	// Get the `hide_title` attribute.
	$hide_title = get_post_meta( $post->ID, 'hide_title', true );

	// WooCommerce expects `show_title` so reverse `hide_title`.
	return ! $hide_title;
}

/**
 * Add the chosen featured image to the top of the product page
 *
 * @param array   $array Array (view WooCommerce source code for context).
 * @param integer $int Integer (view WooCommerce source code for context).
 */
function emma_add_product_page_featured_image( $array, $int ) {
	if ( is_shop() ) {
		echo "<div class='shop-featured-image'>" . get_the_post_thumbnail( get_option( 'woocommerce_shop_page_id' ) ) . '</div>';
	}
}

/**
 * Add an opening div before the product sorting on the shop page
 */
function emma_add_product_sorting_open_div() {
	echo "<div class='woocommerce-product-sorting'>";
}

/**
 * Add a closing div (initially for use after the product sorting on the shop page, but could be used elsewhere)
 */
function emma_add_close_div() {
	echo '</div> <!-- .woocommerce-product-sorting -->';
}

/**
 * Adds column sizer buttons on shop page
 */
function emma_add_product_sorting_column_sizer() {
	$columns = (int) apply_filters( 'loop_shop_columns', 2 );
	?>

	<ul class='woocommerce-columns-sizers'>
		<li class='woocommerce-columns-sizer columns-1 <?php echo ( 1 === $columns ) ? 'active' : ''; ?>'>
			<a href='#' data-size="columns-1">
				<span class="screen-reader-text">Make Columns Small Size</span>
				<svg xmlns="http://www.w3.org/2000/svg" tabindex=-1 preserveAspectRatio="xMidYMin meet" viewBox="0 0 24 24"><rect tabindex=-1 x="18" y="9" width="6" height="6"/><rect tabindex=-1 x="18" y="18" width="6" height="6"/><rect tabindex=-1 x="9" y="18" width="6" height="6"/><rect tabindex=-1 y="18" width="6" height="6"/><rect tabindex=-1 x="9" y="9" width="6" height="6"/><rect tabindex=-1 y="9" width="6" height="6"/><rect tabindex=-1 x="9" width="6" height="6"/><rect tabindex=-1 width="6" height="6"/><rect tabindex=-1 x="18" width="6" height="6"/></svg>
			</a>
		</li>
		<li class='woocommerce-columns-sizer columns-2 <?php echo ( 2 === $columns ) ? 'active' : ''; ?>'>
			<a href='#' data-size="columns-2">
				<span class="screen-reader-text">Make Columns Medium Size</span>
				<svg xmlns="http://www.w3.org/2000/svg" tabindex=-1 preserveAspectRatio="xMidYMin meet" viewBox="0 0 24 24"><rect tabindex=-1 width="10" height="10"/><rect tabindex=-1 x="14" width="10" height="10"/><rect tabindex=-1 x="14" y="14" width="10" height="10"/><rect tabindex=-1 y="14" width="10" height="10"/></svg>
			</a>
		</li>
		<li class='woocommerce-columns-sizer columns-3 <?php echo ( 3 === $columns ) ? 'active' : ''; ?>'>
			<a href='#' data-size="columns-3">
				<span class="screen-reader-text">Make Columns Large Size</span>
				<svg xmlns="http://www.w3.org/2000/svg" tabindex=-1 preserveAspectRatio="xMidYMin meet" viewBox="0 0 24 24"><rect tabindex=-1 width="24" height="24"/></svg>
			</a>
		</li>
	</ul>

	<?php
}

/**
 * Hijack the column count hook
 *
 * In WooCommerce we use the column count hook to insert our custom column classes (sm, md, lg)
 *
 * @param integer $columns Number of columns.
 */
function emma_product_columns( $columns ) {
	// Change to adjust default (1 = SM, 2 = MD, 3 = LG).
	$columns = 2;

	return $columns;
}

/**
 * Set a column count for related products
 *
 * @param array $args Array of arguments.
 */
function emma_related_product_columns( $args ) {
	// Change to adjust default (1 = SM, 2 = MD, 3 = LG).
	$args['columns'] = 2;

	return $args;
}

/**
 * Hard set the number of items shown on the shop page so that the product_columns number doesn't mess with it
 *
 * @param integer $products Number of products to display.
 */
function emma_products_per_page( $products ) {
	// Twelve products maximizes the column layout options (see factors of 12).
	$products = 12;
	return $products;
}

/**
 * Adds the cart anchor markup to WC's cart fragments
 *
 * @param array $fragments Array of markup fragments.
 */
function emma_cart_anchor_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>

	<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
		<span class='cart-count'><?php echo ( 0 === WC()->cart->get_cart_contents_count() ) ? '' : WC()->cart->get_cart_contents_count(); ?></span>
		<?php echo ( 0 === WC()->cart->get_cart_contents_count() ) ? 'Cart Empty' : 'Item(s) in Cart'; ?>
	</a>

	<?php
	$fragments['.mini-cart-toggle > a'] = ob_get_clean();

	return $fragments;
}
