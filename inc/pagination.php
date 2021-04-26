<?php
/**
 * Render post pagination
 */
function emma_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => '<span class="screen-reader-text">' . __( 'previous', 'emma' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'next', 'emma' ) . '</span>',
		)
	);
}
