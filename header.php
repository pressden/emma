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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'emma' ); ?></a>

	<header id="masthead" class="site-header">

    <?php get_template_part( 'template-parts/utility', 'bar' ); ?>

    <div class="wrap">

      <?php if ( has_nav_menu( 'left' ) ) : ?>
        <nav id="left-navigation" class="split-navigation split-left-navigation">
          <?php
          wp_nav_menu( array(
            'theme_location'  => 'left',
            'menu_id'         => 'left-menu',
          ) );
          ?>
        </nav><!-- #left-navigation -->
      <?php endif; ?>

      <div class="site-branding">
        <?php
        the_custom_logo();
        if ( is_front_page() && is_home() ) :
          ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php
        else :
          ?>
          <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
          <?php
        endif;
        $emma_description = get_bloginfo( 'description', 'display' );
        if ( $emma_description || is_customize_preview() ) :
          ?>
          <p class="site-description"><?php echo $emma_description; /* WPCS: xss ok. */ ?></p>
        <?php endif; ?>
      </div><!-- .site-branding -->

      <?php if ( has_nav_menu( 'right' ) ) : ?>
        <nav id="right-navigation" class="split-navigation split-right-navigation">
          <button class="menu-toggle" aria-controls="right-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'emma' ); ?></button>
          <?php
          wp_nav_menu( array(
            'theme_location'  => 'right',
            'menu_id'         => 'right-menu',
          ) );
          ?>
        </nav><!-- #right-navigation -->
      <?php endif; ?>

    </div><!-- .wrap -->

    <?php if ( has_nav_menu( 'primary' ) ) : ?>
      <nav id="main-navigation" class="main-navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'emma' ); ?></button>
        <?php
        wp_nav_menu( array(
          'theme_location'  => 'primary',
          'menu_id'         => 'primary-menu',
        ) );
        ?>
      </nav><!-- #main-navigation -->
    <?php endif; ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
