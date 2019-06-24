<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) ): ?>

  <div id="back-matter" class="footer-widgets">
    <div class="wrap">

      <?php
      for( $i = 1; $i <= 3; $i++ ) {
        if ( is_active_sidebar( 'footer-widgets-' . $i ) ) {
          ?>

          <div class="footer-widgets-<?php echo $i; ?>">
            <?php dynamic_sidebar( 'footer-widgets-' . $i ); ?>
          </div>

          <?php
        }
      }
      ?>

    </div><!-- .wrap -->
  </div><!-- #back-matter -->

<?php endif; ?>
