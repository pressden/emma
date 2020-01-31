<nav id="menu-drawer" class="menu-drawer">
  <div class="wrap">
    <div class="navigation-controls">
      <a href="javascript:void(0);" id="menu-closer" class="menu-toggle menu-closer" <?php /*aria-controls="menu-drawer" aria-expanded="false"*/?> title="<?php esc_html_e( 'Close Primary Menu', 'emma' ); ?>">
        <span class="dashicons dashicons-no-alt"></span>
        <span class="screen-reader-text">Close Menu</span>
      </a>
    </div><!-- .navigation-controls -->

    <div id="menu-clones" class="menu-container">
      <?php // menus placed here via Javascript (see: src/js/navigation.js) ?>
    </div>
  </div><!-- .wrap -->
</nav>
