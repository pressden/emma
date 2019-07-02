<?php if ( is_active_sidebar( 'utility-widgets-1' ) || is_active_sidebar( 'utility-widgets-2' ) ): ?>

  <div id="mastutils" class="utility-bar">
    <div class="wrap">

      <?php
      for( $i = 1; $i <= 2; $i++ ) {
        if ( is_active_sidebar( 'utility-widgets-' . $i ) ) {
          ?>

          <div class="utility-widgets-<?php echo $i; ?>">
            <?php dynamic_sidebar( 'utility-widgets-' . $i ); ?>
          </div>

          <?php
        }
      }
      ?>

    </div><!-- .wrap -->
  </div><!-- #back-matter -->

<?php endif; ?>
