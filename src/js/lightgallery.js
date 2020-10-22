( function() {
  document.querySelectorAll( ".lightgallery" ).forEach( gallery => {
    lightGallery( gallery, {
      selector: 'figure a'
    } );
  } );
} )();
