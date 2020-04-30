<?php
if ( is_active_sidebar( 'header-widgets' ) ) {
  ?>

  <div id="header-widgets" class="header-widgets">

    <?php dynamic_sidebar( 'header-widgets' ); ?>

  </div>

  <?php
}
?>
