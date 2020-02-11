jQuery( document ).ready( function() {
  jQuery( document ).on( 'nfFormSubmitResponse', function( event, response, id ) {
    if(window.ga && ga.create) {
      ga( 'send', 'event', 'Contact', 'Form Submission', response.response.data.settings.title );
    }
  });
});
