( function() {
  document.addEventListener( 'click', function( event ) {
    var link_extend = event.target.closest( '.link-extend' )
    if( link_extend ) {
      var anchor = link_extend.querySelector( 'a' );
      if( anchor ) {
        window.location = anchor.getAttribute( 'href' );
      }
    }
  } );
} )();;
