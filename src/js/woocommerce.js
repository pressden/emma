/**
 * MINI-CART FUNCTIONS
 */

function hideMiniCart() {
  if( $( '#mini-cart' ).is( ':visible' ) ) {
    $( '#mini-cart' ).hide();
  }
}

$( function() {
  $( document ).on( 'click focus', '.mini-cart-toggle > a', function( e ) {
    e.preventDefault();

    var $toggle = $( this );
    var $miniCart = $( '#mini-cart' );

    var docHeight = $( document ).outerHeight( true );
    var docWidth = $( document ).outerWidth( true );

    var miniCartWidth = $miniCart.outerWidth( true );
    var miniCartHeight = $miniCart.outerHeight( true );

    var toggleHeight = $toggle.outerHeight( true );
    var toggleWidth = $toggle.outerWidth();
    var toggleTop = $toggle.offset().top;
    var toggleBottom = toggleTop + toggleHeight;
    var toggleLeft = $toggle.offset().left;
    var toggleRight = toggleLeft + toggleWidth;

    if( toggleLeft + miniCartWidth > docWidth ) {
      $miniCart.css( 'left', -miniCartWidth + toggleWidth );
    } else {
      $miniCart.css( 'left', 0 );
    }

    if( toggleBottom + miniCartHeight > docHeight ) {
      $miniCart.css( 'top', -miniCartHeight - 4 );
    } else {
      $miniCart.css( 'top', toggleHeight + 4 );
    }

    $miniCart.insertAfter( $toggle );
    $miniCart.show();

    e.stopPropagation();
  } );

  $( '#mini-cart-close' ).click( function( e ) {
    e.preventDefault();
    hideMiniCart();
  } );

  $( 'html' ).click( function( e ) {
    var $target = $( e.target );

    if( ! $target.closest( '#mini-cart' ).length ) {
      hideMiniCart();
    }
  } );

  $( '*' ).focus( function() {
    if( ! $( this ).hasClass( '.mini-cart-toggle' ) && ! $( this ).closest( '#mini-cart' ).length ) {
      hideMiniCart();
    }
  } );
} );