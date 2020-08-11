document.addEventListener( "DOMContentLoaded", function() {
  var dialogs = document.querySelectorAll( '.wp-block-emma-dialog' ).forEach( dialog => {
    document.body.appendChild( dialog );
    dialogPolyfill.registerDialog( dialog );

    var options = JSON.parse( dialog.dataset.options );

    // attach dialog open event handlers to links with the appropriate hrefs
    if( options.openLinkAddress !== '' ) {
      document.querySelectorAll( "[href='#" + options.openLinkAddress + "']" ).forEach( link => {
        link.addEventListener( 'click', function( event ) {
          event.preventDefault();
          dialog.showModal();
        } );
      } );
    }

    var openCount = localStorage.getItem( options.openLimitID ) || 0;
    if( options.openLimit === 0 || openCount === undefined || openCount < options.openLimit ) {
      if( options.openDelay ) {
        setTimeout( function() {
          dialog.showModal();
          if( options.openLimitID ) {
            localStorage.setItem( options.openLimitID, parseInt( openCount ) + 1 );
          }
        }, options.openDelay * 1000 );
      }
    }
  } );
} );
