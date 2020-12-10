<?php if ( get_theme_mod( 'sitewide_alert_enable' ) && get_theme_mod( 'sitewide_alert_text' ) ): ?>

<div id="sitewide-alert" class="sitewide-alert">
  <div class="wrap">
    <?php echo get_theme_mod( 'sitewide_alert_text' ); ?>
  </div><!-- .wrap -->
</div><!-- #sitewide-alert -->

<?php endif; ?>
