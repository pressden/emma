<?php if ( 'post' === get_post_type() ) : ?>

  <div class="entry-meta">
    <?php
    emma_posted_on();
    emma_posted_by();
    ?>
  </div><!-- .entry-meta -->

<?php endif; ?>
