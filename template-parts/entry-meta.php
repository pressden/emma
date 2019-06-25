<?php if ( 'post' === get_post_type() ) : ?>

  <div class="entry-meta">
    <div class="wrap">

      <?php
      emma_posted_on();
      emma_posted_by();
      ?>

    </div><!-- .wrap -->
  </div><!-- .entry-meta -->

<?php endif; ?>
