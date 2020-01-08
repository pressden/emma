<?php

function emma_pagination() {

  if ( is_singular() ) {
    return;
  }

  global $wp_query;

  // Stop execution if there's only one page.
  if ( $wp_query->max_num_pages <= 1 ) {
    return;
  }

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = (int) $wp_query->max_num_pages;

  // Add current page to the array.
  if ( $paged >= 1 ) {
    $links[] = $paged;
  }

  // Add the pages around the current page to the array.
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  $screen_reader_text = "<span class='screen-reader-text'>Page</span>";
  $pagination_omission = "<li class='pagination-omission'>&#x02026;</li>";

  sort( $links );

  ?>

  <nav class="archive-pagination">
    <ul>

      <?php if ( get_previous_posts_link() ) { ?>
        <li class="pagination-previous"><?php echo get_previous_posts_link( 'Previous Page' ); ?></li>
      <?php } ?>

      <?php if ( ! in_array( 1, $links, true ) ) { ?>
        <li><a href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>"><?php echo $screen_reader_text; ?>1</a></li>

        <?php if ( ! in_array( 2, $links, true ) ) { ?>
          <?php echo $pagination_omission; ?>
        <?php } ?>
      <?php } ?>

      <?php foreach ( (array) $links as $link ) { ?>

        <li>
          <?php if ( $paged != $link ) { ?>
            <a href="<?php echo esc_url( get_pagenum_link( $link ) ); ?>" >
          <?php } ?>
            <?php echo $screen_reader_text . $link; ?>
          <?php if ( $paged != $link ) { ?>
            </a>
          <?php } ?>
        </li>
      <?php } ?>

      <?php if ( ! in_array( $max, $links, true ) ) { ?>
        <?php if ( ! in_array( $max - 1, $links, true ) ) { ?>
          <?php echo $pagination_omission; ?>
        <?php } ?>

        <li><a href="<?php echo esc_url( get_pagenum_link( $max ) ); ?>"><?php echo $screen_reader_text . $max; ?></a></li>
      <?php } ?>

      <?php if ( get_next_posts_link() ) { ?>
        <li class="pagination-next"><?php echo get_next_posts_link( 'Next Page' ); ?></li>
      <?php } ?>
    </ul>
  </nav>
<?php }
