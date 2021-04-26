<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emma
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
/**
 * Fires after the opening body tag.
 *
 * @since 1.0.0
 */
do_action( 'emma_before' );
?>

<div id="page" class="site">

	<?php
	/**
	 * Fires before the site-header markup.
	 *
	 * @since 1.0.0
	 */
	do_action( 'emma_before_header' );
	?>

	<header id="masthead" class="site-header">

		<?php
		/**
		 * Fires inside the site-header markup before the opening wrap tag.
		 *
		 * This action is ideal for high visibility items such as alert bars,
		 * account information and global functionality that remains visible at all
		 * breakpoints (e.g. search, mini cart, login/logout links).
		 *
		 * @since 1.0.0
		 */
		do_action( 'emma_header_bar' );
		?>

	</header><!-- #masthead -->

	<?php
	/**
	 * Fires after the site-header markup.
	 *
	 * @since 1.0.0
	 */
	do_action( 'emma_after_header' );
	?>

	<div id="content" class="site-content">
