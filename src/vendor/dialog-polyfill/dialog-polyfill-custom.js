document.addEventListener( "DOMContentLoaded", function() {
  var dialogs = document.querySelectorAll( '.wp-block-emma-dialog' ).forEach( dialog => {
    document.body.appendChild( dialog );
    dialogPolyfill.registerDialog( dialog );

    var options = JSON.parse( dialog.dataset.options );

    // attach dialog open event handlers to links with the appropriate hrefs
    if( options.openLinkAddress !== '' ) {
      document.querySelectorAll( "[href='" + options.openLinkAddress + "']" ).forEach( link => {
        link.addEventListener( 'click', function( event ) {
          event.preventDefault();
          dialog.showModal();
          dialog.dataset.opened = true;
        } );
      } );
    }

    if( options.openLoggedIn || !document.querySelector( 'body' ).classList.contains( 'logged-in' ) ) {
      var lastOpenedID = options.openLimitID + '-lastopened';
      var openCountID = options.openLimitID + '-opencount';

      var lastOpened = localStorage.getItem( lastOpenedID ) || 0;
      var openLimitExpiration = options.openLimitExpiration;
      if( openLimitExpiration > 0 && Date.now() - ( openLimitExpiration * 86400 ) > lastOpened ) {
        localStorage.setItem( openCountID, 0 );
      }
      var openCount = localStorage.getItem( openCountID ) || 0;
      if( options.openLimit === 0 || openCount === undefined || openCount < options.openLimit ) {
        if( options.openDelay ) {
          setTimeout( function() {
            if( ! dialog.dataset.opened ) {
              dialog.showModal();
            }
            if( options.openLimitID ) {
              localStorage.setItem( openCountID, parseInt( openCount ) + 1 );
              localStorage.setItem( lastOpenedID, Date.now() );
            }
          }, options.openDelay * 1000 );
        }
      }
    }
  } );
} );
