$( function() {
  var $target = $( '.wp-block-emma-flexslider' );
  if( $target.length ) {
    var flexslider = { vars:{} };
    var settings = $target.data( 'flexslider-settings' );

    if( settings.fullItems ) {
      var minItemWidth = settings.itemWidth;

      function getSlideCount() {
        return  Math.floor( $target.width() / minItemWidth );
      }

      settings.minItems = getSlideCount();
      settings.maxItems = getSlideCount();
    }

    settings.start = function( $target ) {
      flexslider = $target;
    }

    $target.flexslider( settings );

    if( settings.fullItems ) {
      $( window ).resize(function() {
        var slideCount = getSlideCount();
        flexslider.vars.minItems = slideCount;
        flexslider.vars.maxItems = slideCount;
      } );
    }
  }
} );
