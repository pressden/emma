jQuery( document ).ready( function() {
  jQuery( document ).on( 'nfFormSubmitResponse', function( event, response, id ) {
    if(window.ga && ga.create) {
      tracker = ga.getAll()[0];
      if (tracker) {
        tracker.send( 'event', 'Contact', 'Form Submission', response.response.data.settings.title );
      }
    }
  });
});
