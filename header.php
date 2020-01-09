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
 * Fires immediately after the body element opening markup.
 *
 * @since 1.0.0
 */
do_action( 'emma_before' );
?>

<div id="page" class="site">
  <a class="skip-link screen-reader-shortcut" href="#content"><?php esc_html_e( 'Skip to content', 'emma' ); ?></a>

	<header id="masthead" class="site-header">

    <?php get_template_part( 'template-parts/utility', 'bar' ); ?>

    <div class="wrap">

      <?php if ( has_nav_menu( 'left' ) ) : ?>
        <nav id="left-navigation" class="site-navigation split-navigation split-left-navigation">
          <?php
          wp_nav_menu( array(
            'theme_location'  => 'left',
            'menu_id'         => 'left-menu',
            'container_class' => 'menu-container',
          ) );
          ?>
        </nav><!-- #left-navigation -->
      <?php endif; ?>

      <div class="site-branding">
        <?php do_action( 'site_branding' ); ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php
        $emma_description = get_bloginfo( 'description', 'display' );
        if ( $emma_description || is_customize_preview() ) :
          ?>
          <p class="site-description"><?php echo $emma_description; /* WPCS: xss ok. */ ?></p>
        <?php endif; ?>
      </div><!-- .site-branding -->

      <?php if ( has_nav_menu( 'right' ) ) : ?>
        <nav id="right-navigation" class="site-navigation split-navigation split-right-navigation">
          <?php
          wp_nav_menu( array(
            'theme_location'  => 'right',
            'menu_id'         => 'right-menu',
            'container_class' => 'menu-container',
          ) );
          ?>
        </nav><!-- #right-navigation -->
      <?php endif; ?>

      <?php
      if ( is_active_sidebar( 'header-widgets' ) ) {
        ?>

        <div id="header-widgets" class="header-widgets">
          <?php dynamic_sidebar( 'header-widgets' ); ?>
        </div>

        <?php
      }
      ?>

      <div class="navigation-controls">
        <a href="javascript:void(0);" id="menu-toggle" class="menu-toggle" aria-controls="menu-drawer" aria-expanded="false" title="<?php esc_html_e( 'Primary Menu', 'emma' ); ?>">
          <span class="dashicons dashicons-menu-alt"></span>
        </a>
      </div><!-- .navigation-controls -->

    </div><!-- .wrap -->

  </header><!-- #masthead -->

  <div id="sticky-saver" class="sticky-saver"></div>

  <?php if ( has_nav_menu( 'primary' ) ) : ?>
      <nav id="main-navigation" class="site-navigation main-navigation">
        <?php
        wp_nav_menu( array(
          'theme_location'  => 'primary',
          'menu_id'         => 'primary-menu',
          'container_class' => 'menu-container',
        ) );
        ?>
      </nav><!-- #main-navigation -->
    <?php endif; ?>

	<div id="content" class="site-content">
