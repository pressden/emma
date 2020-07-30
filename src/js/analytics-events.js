var Analytics = function() {
  var initialized = false;

  return {
    initialize: function() {
      //checks if either already initialized or if ga function exists, indicating GA is present and loaded
      if ( initialized || typeof ga !== 'function' ) {
        return
      }
      initialized = true;
    },

    fireEvent: function( eventCategory, eventAction, eventLabel ) {
      if( initialized ) {
        ga( 'send', {
          hitType: 'event',
          eventCategory: eventCategory,
          eventAction: eventAction,
          eventLabel: eventLabel,
        } );
      }
    }
  }
}();

var Facebook = function() {
  var initialized = false;

  return {
    initialize: function() {
      //checks if either already initialized or if fbq function exists, indicating Pixel is present and loaded
      if ( initialized || typeof fbq !== 'function' ) {
        return
      }
      initialized = true;
    },

    fireEvent: function( eventType, event, params ) {
      if( initialized ) {
        fbq( eventType, event, params );
      }
    }
  }
}();

function getLinkExtension (link) {

  // Remove anchor, query string and everything before last slash
  link = link.substring(0, (link.indexOf("#") === -1) ? link.length : link.indexOf("#"));
  link = link.substring(0, (link.indexOf("?") === -1) ? link.length : link.indexOf("?"));
  link = link.substring(link.lastIndexOf("/") + 1, link.length);

  // If there's a period left in the URL, then there's a extension
  if (link.length > 0 && link.indexOf('.') !== -1) {
      link = link.substring(link.indexOf(".") + 1); // Remove everything but what's after the first period
      return link;
  } else {
      return "";
  }
}

function getLinkFilename (link) {

  // Remove anchor, query string and everything before last slash
  link = link.substring(0, (link.indexOf("#") === -1) ? link.length : link.indexOf("#"));
  link = link.substring(0, (link.indexOf("?") === -1) ? link.length : link.indexOf("?"));
  link = link.substring(link.lastIndexOf("/") + 1, link.length);

  // If there's a period left in the URL, then there's a extension
  if (link.length > 0 && link.indexOf('.') !== -1) {
      return link;
  } else {
      return "";
  }
}

function initialize() {
  Analytics.initialize();
}

( function() {
  initialize();

  document.addEventListener( 'click', function( event ) {
    var el = event.target;

    // loop through parent elements if clicked element is not an anchor tag (eg: an image inside a link)
    while (el && (typeof el.tagName === 'undefined' || el.tagName.toLowerCase() !== 'a' || !el.href)) {
      el = el.parentNode;
    }

    if (el && el.href) {
      if( el.href.startsWith( 'tel:' ) ) {
        Analytics.fireEvent( 'Contact', 'Phone Number Click', href.substring( 4 ) );
        Facebook.fireEvent( 'trackCustom', 'Contact', {
          content_category: 'Phone Number Click',
          content_name: href.substring( 4 )
        } );
      }

      if( el.href.startsWith( 'mailto:' ) ) {
        Analytics.fireEvent( 'Contact', 'Email Address Click', href.substring( 7 ) );
        Facebook.fireEvent( 'trackCustom', 'Contact', {
          content_category: 'Email Address Click',
          content_name: href.substring( 7 )
        } );
      }

      if( getLinkExtension( el.href ) == 'pdf' ) {
        Analytics.fireEvent( 'File', 'Download', getLinkFilename( el.href ) );
        Facebook.fireEvent( 'track', 'ViewContent', {
          content_category: 'Download',
          content_name: getLinkFilename( el.href ),
        } );
      }
    }
  } );
} ) ();

window.onload = function() {
  //handles analytics for jQuery-fired events that can't be captured with vanilla js
  if( typeof jQuery === 'function' ) {
    jQuery( document ).on( 'nfFormSubmitResponse', function( event, response, id ) {
      Analytics.fireEvent( 'Contact', 'Form Submission', response.response.data.settings.title );
      Facebook.fireEvent( 'trackCustom', 'Contact', {
        content_category: 'Form Submission',
        content_name: response.response.data.settings.title
      } );
    });
  }
}
