( function() {
  document.addEventListener( 'click', function( event ) {
    if(window.ga && ga.create) {
      tracker = ga.getAll()[0];
      if (tracker) {
        var href = event.target.href;
        if( href.substring( 0, 4 ) == 'tel:' ) {
          tracker.send( 'event', 'Contact', 'Phone Number Click', href.substring( 4 ) );
        }

        if( href.substring( 0, 7 ) == 'mailto:' ) {
          tracker.send( 'event', 'Contact', 'Email Click', href.substring( 7 ) );
        }

        if( href.substring( href.length - 4 ) == '.pdf' ) {
          tracker.send( 'event', 'File', 'Download', href.substring( href.lastIndexOf('/') + 1 ) );
        }
      }
    }
  } );
} ) ();
