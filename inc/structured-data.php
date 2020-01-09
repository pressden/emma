<?php

function structured_data() {
  $default_types = [];

  $default_types['Organization'] = array(
    '@type' => 'Organization',
    'name'  => get_bloginfo( 'name' ),
    'url'   => esc_url( home_url( '/' ) ),
    'logo'  => wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ),
  );

  $types = apply_filters( 'structured_data', $default_types );

  echo '<script type="application/ld+json">';
  foreach( $types as $type => $data ) {
    $data = array( '@context' => 'https://schema.org' ) + $data;
    echo json_encode( $data );
  }
  echo '</script>';

}
add_action( 'wp_head', 'structured_data' );
