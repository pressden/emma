/**
 * COLUMN SIZER FUNCTIONS
 */

function changeColumnSize( d ) {

}

$( function() {
  $productsList = $( 'ul.products' );
  var currentColumnSize = $productsList.attr( 'class' ).split( /\s+/ )[1];

  $( '.woocommerce-columns-sizer a' ).click( function( e ) {
    e.preventDefault();

    var newColumnSize = $( this ).data( 'size' );

    if( currentColumnSize != newColumnSize ) {
      $productsList.removeClass( currentColumnSize );
      $productsList.addClass( newColumnSize );
      currentColumnSize = newColumnSize;

      $( '.woocommerce-columns-sizer.active' ).removeClass( 'active' );
      $( '.woocommerce-columns-sizer.' + newColumnSize ).addClass( 'active' );
      document.cookie = "column_size=" + newColumnSize.slice( -1 );
    }
  } );
} );
