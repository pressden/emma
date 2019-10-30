/**
 * MINI-CART FUNCTIONS
 */

$( function() {
  $( document ).on( 'click focus', '.mini-cart-toggle a', function( e ) {
    e.preventDefault();

    var toggle = $( this );
    var mini_cart = $( '#mini-cart' );

    var doc_height = $( document ).outerHeight( true );
    var doc_width = $( document ).outerWidth( true );

    var mini_cart_width = mini_cart.outerWidth( true );
    var mini_cart_height = mini_cart.outerHeight( true );


    var toggle_top = toggle.offset().top;
    var toggle_bottom = toggle_top + toggle.outerHeight( true );
    var toggle_left = toggle.offset().left;
    var toggle_right = toggle_left + toggle.outerWidth();

    if( toggle_left + mini_cart_width > doc_width ) {
      mini_cart.css( 'left', toggle_right - mini_cart_width + 10 );
    } else {
      mini_cart.css( 'left', toggle_left - 10 );
    }

    if( toggle_bottom + mini_cart_height > doc_height ) {
      mini_cart.css( 'top', toggle_top - mini_cart_height - 4 );
    } else {
      mini_cart.css( 'top', toggle_bottom + 4 );
    }

    mini_cart.addClass( 'open' );

    e.stopPropagation();
  } );

  $( document ).click( function() {
    $( '#mini-cart' ).hide();
  } );
} );