<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) ): ?>

  <aside id="back-matter" class="footer-widgets">
    <div class="wrap">

      <?php
      for( $i = 1; $i <= 3; $i++ ) {
        if ( is_active_sidebar( 'footer-widgets-' . $i ) ) {
          ?>

          <section class="footer-widgets-<?php echo $i; ?> widget-area">
            <?php dynamic_sidebar( 'footer-widgets-' . $i ); ?>
          </section>

          <?php
        }
      }
      ?>

    </div><!-- .wrap -->
  </aside><!-- #back-matter -->

<?php endif; ?>
