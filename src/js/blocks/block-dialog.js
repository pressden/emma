( function() {
  document.querySelectorAll( '.wp-block-emma-dialog' ).forEach( dialog => {
    document.body.appendChild( dialog );
    dialogPolyfill.registerDialog( dialog );

    var options = JSON.parse( dialog.dataset.options );

    // attach dialog open event handlers to links with the appropriate hrefs
    if( options.openLinkAddress !== '' ) {
      document.querySelectorAll( "[href='" + options.openLinkAddress + "']" ).forEach( link => {
        link.addEventListener( 'click', function( event ) {
          var vw = window.innerWidth;
          if( ( options.openOn === 'desktop' && vw <= 600 ) || ( options.openOn === 'mobile' && vw > 600 ) ) {
            return;
          }
          event.preventDefault();
          dialog.showModal();
          dialog.dataset.opened = true;
        } );
      } );
    }

    // return if the dialog does not have an automatic open setting
    if( ! options.openAutomatically ) {
      return
    }

    // return if not the correct device
    var vw = window.innerWidth;
    if( ( options.openOn === 'desktop' && vw <= 600 ) || ( options.openOn === 'mobile' && vw > 600 ) ) {
      return;
    }

    // return if not the correct logged-in status
    var loggedIn = document.querySelector( 'body' ).classList.contains( 'logged-in' );
    if( ( loggedIn && options.openUsers === 'logged-out' ) || ( !loggedIn && options.openUsers === 'logged-in' ) ) {
      return
    }

    if( options.openLimit ) {
      options.lastOpenedID = options.openLimitID + '-lastopened';
      options.openCountID = options.openLimitID + '-opencount';
      var lastOpened = localStorage.getItem( options.lastOpenedID ) || 0;
      var openLimitExpiration = options.openLimitExpiration;

      //set open count back to zero if it has been long enough since the last open
      if( openLimitExpiration > 0 && Date.now() - ( openLimitExpiration * 86400 ) > lastOpened ) {
        localStorage.setItem( options.openCountID, 0 );
      }
      options.openCount = localStorage.getItem( options.openCountID ) || 0;

      // return if open limit is exceeded
      if( options.openCount >= options.openLimit ) {
        return
      }
    }

    if( options.openAutomatically === 'delay' ) {
      setTimeout( function() {
        openDialog( dialog, options );
      }, options.openDelay * 1000 );
    }

    if( options.openAutomatically === 'exit' ) {
      document.addEventListener( 'mouseout', function( event ) {
        if (!event.toElement && !event.relatedTarget) {
          openDialog( dialog, options );
        }
      } );

      document.addEventListener( 'touchstart', function() {
        document.body.classList.add( 'on-touch-device' );
      }, {
        passive: true,
      } );

      document.addEventListener( 'scroll', function() {
        if( document.body.classList.contains( 'on-touch-device' ) ){
          if( my_scroll() < -120 ) {
            openDialog( dialog, options );
          }
        }
      } );

      var my_scroll = (function(){ //Function that checks the speed of scrolling
      var last_position, new_position, timer, delta, delay = 50;
      function clear() {
          last_position = null;
          delta = 0;
      }

      clear();
      return function(){
          new_position = window.scrollY;
          if ( last_position != null ){
              delta = new_position -  last_position;
          }
          last_position = new_position;
          clearTimeout(timer);
          timer = setTimeout(clear, delay);
          return delta;
      };
      })();
    }
  } );

  document.querySelectorAll( '.close-dialog' ).forEach( button => {
    button.addEventListener( 'click', function( event ) {
      button.closest( 'dialog' ).close();
      if( button.getAttribute( 'href' ) === '#' ) {
        event.preventDefault();
      }
    } );
  } );
} )();

function openDialog( dialog, options ) {
  if( ! dialog.dataset.opened ) {
    dialog.showModal();
    dialog.dataset.opened = true;

    if( options.openLimitID ) {
      localStorage.setItem( options.openCountID, parseInt( options.openCount ) + 1 );
      localStorage.setItem( options.lastOpenedID, Date.now() );
    }
  }
}
