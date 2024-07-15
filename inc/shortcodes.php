<?php
/**
 * Shortcodes
 *
 * @link https://developer.wordpress.org/plugins/shortcodes/
 *
 * @since 0.1
 */

function emma_year_shortcode () {
  return date_i18n( 'Y' );
}
add_shortcode( 'year', 'emma_year_shortcode' );

function emma_site_name_shortcode () {
  return get_option( 'blogname' );
}
add_shortcode( 'site_name', 'emma_site_name_shortcode' );

function emma_flyout_menu_shortcode ( $atts = array() ) {
  $atts = array_change_key_case( (array) $atts, CASE_LOWER );
  $menu_atts = shortcode_atts(
    array(
      'menus'           => null,
      'secondary_menus' => null
    ), $atts
  );

  if ( ! $menu_atts['menus'] ) {
    $args = array(
      'post_type' => 'wp_navigation'
    );
  } else {
    $menu_ids = explode( ",", $menu_atts['menus'] );
    $args = array(
      'post_type' => 'wp_navigation',
      'post__in'  => $menu_ids,
      'orderby' => 'post__in'
    );
  }

  $query = new WP_Query( $args );

  if ( ! $query->have_posts() ) {
    return;
  }

  if ( $menu_atts['secondary_menus'] ) {
    $secondary_menu_ids = explode( ",", $menu_atts['secondary_menus'] );
    $secondary_args = array(
      'post_type' => 'wp_navigation',
      'post__in'  => $secondary_menu_ids,
      'orderby' => 'post__in'
    );

    $secondary_query = new WP_Query( $secondary_args );
  }

  ob_start();
  ?>

  <div class="flyout-menu__background flyout-menu-closer focus-trap"></div>
  <div style="transform: translateX( 100% );" id="flyout-menu" class="flyout-menu focus-trap">
    <button class="flyout-menu-closer close-icon"><span class="screen-reader-text">Close Menu</span></button>
    <div class="flyout-menu__inner-container">
      <div class="flyout-menu__menus">
        <div class="top-menu__inner-container menu-container">
          <ul class="primary-menu">
            <li><button class="flyout-menu-closer menu-back">Close Menu</button></li>

            <?php
            while ( $query->have_posts() ) {
              $query->the_post();
              $menu_array = parse_blocks( get_the_content() );
              emma_menu_output( $menu_array, 'Main Menu' );
            }
            ?>

          </ul>

          <?php if ( isset( $secondary_query ) && $secondary_query->have_posts() ) { ?>

            <ul class="secondary-menu">

              <?php
              while ( $secondary_query->have_posts() ) {
                $secondary_query->the_post();
                $menu_array = parse_blocks( get_the_content() );
                emma_menu_output( $menu_array, 'Main Menu' );
              }
              ?>

            </ul>

            <?php
          }
          ?>

        </div>
      </div>
    </div>
  </div>

  <?php
  return ob_get_clean();
}
add_shortcode ('flyout_menu', 'emma_flyout_menu_shortcode');

function emma_menu_output( $menu_array, $parent_menu_name ) {
  foreach( $menu_array as $menu_item ) {
    if ( str_starts_with( $menu_item['blockName'], 'core/navigation' ) ) { ?>
    <li>
      <?php if ( $menu_item['innerBlocks'] ) {?>
      <details>
        <summary><?= $menu_item['attrs']['label']; ?></summary>
        <div class="submenu menu-container">
        <div class="submenu__inner-container">
          <ul>
          <li><button class="menu-back"><?= $parent_menu_name; ?></button></li>
          <li class="top-level-menu-item"><a href="<?= $menu_item['attrs']['url'] ?>"><?= $menu_item['attrs']['label']; ?></a></li>
          <?php emma_menu_output( $menu_item['innerBlocks'], $menu_item['attrs']['label'] ); ?>
          </ul>
        </div>
        </div>
      </details>
      <?php } elseif ( ! str_contains( $menu_item['attrs']['className'] ?? '', 'flyout-menu-opener' ) ) { ?>
      <a href="<?= $menu_item['attrs']['url'] ?>"><?= $menu_item['attrs']['label']; ?></a>
      <?php } ?>
    </li>
    <?php }
  }
}