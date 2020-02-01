( function() {
  document.querySelectorAll( '.glide__main' ).forEach( item => {
    var sliderSettings = JSON.parse( item.dataset.sliderSettings );
    var slider = new Glide( item, sliderSettings ).mount();

    if( sliderSettings.itemWidth ) {
      var minItemWidth = sliderSettings.itemWidth;

      function setPerView() {
        var maxSlides = Math.floor( item.clientWidth / minItemWidth );
        var actualSlides = item.querySelectorAll( '.glide__slide:not(.glide__slide--clone)' ).length;

        slider.update( {
          perView: Math.min( maxSlides, actualSlides),
        } );

        // if( maxSlides >= actualSlides ) {
        //   slider.disable();
        // } else {
        //   slider.enable();
        // }
      }

      window.addEventListener( 'resize', function() {
        setPerView();
      } );

      setPerView();
    }
  } );
} ) ();
