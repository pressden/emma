$( function() {
  var $target = $( '.wp-block-emma-flexslider' );
  if( $target.length ) {
    $target.flexslider( $target.data( 'flexslider-settings' ) );
  }
} );
