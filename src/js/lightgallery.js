( function() {
  document.querySelectorAll( ".lightgallery" ).forEach( gallery => {
    gallery.querySelectorAll( 'figure a' ).forEach( anchor => {
      var img = anchor.querySelector( 'img' );
      var srcset = img.srcset;
      var sizes = img.sizes;
      anchor.dataset.srcset = srcset;
      anchor.dataset.sizes = sizes;
    } );
    lightGallery( gallery, {
      selector: 'figure a',
      download: false,
    } );
  } );
} )();
