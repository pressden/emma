var Analytics = function() {
  return {
    fireEvent: function( eventCategory, eventAction, eventLabel ) {
      //fires events for universal analytics when UA is enqueued via analytics.js or GTM
      if( typeof ga === 'function' ) {
        var tracker = ga.getAll()[0];
        if( tracker ) {
          tracker.send( 'event', eventCategory, eventAction, eventLabel );
        }
      }
      //fires events for UA or GAv4 when using Global Site Tag
      if( typeof gtag === 'function' ) {
        gtag( 'event', eventAction, {
          'event_category': eventCategory,
          'event_label': eventLabel,
        } );
      }
    }
  }
}();
export default Analytics;

var Facebook = function() {
  return {
    fireEvent: function( eventType, event, params ) {
      if( typeof fbq === 'function' ) {
        fbq( eventType, event, params );
      }
    }
  }
}();
export default Facebook;

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

( function() {
  document.addEventListener( 'submit', function( event ) {
    var form = event.target;
    if( form.action.includes( 'list-manage' ) ) { // for MailChimp
      Analytics.fireEvent( 'Newsletter', 'Subscription', form.id );
      Facebook.fireEvent( 'track', 'CompleteRegistration', {
        content_category: 'Newsletter',
        content_name: form.id
      } );
    }
  } );

  document.addEventListener( 'click', function( event ) {
    var el = event.target;

    var extensions = [
      "doc",
      "docx",
      "exe",
      "js",
      "pdf",
      "ppt",
      "pptx",
      "tgz",
      "zip",
      "xls",
      "xlsx"
    ];

    // loop through parent elements if clicked element is not an anchor tag (eg: an image inside a link)
    while (el && (typeof el.tagName === 'undefined' || el.tagName.toLowerCase() !== 'a' || !el.href)) {
      el = el.parentNode;
    }

    if (el && el.href) {
      if( el.href.startsWith( 'tel:' ) ) {
        Analytics.fireEvent( 'Contact', 'Phone Number Click', el.href.substring( 4 ) );
        Facebook.fireEvent( 'track', 'Contact', {
          content_category: 'Phone Number Click',
          content_name: el.href.substring( 4 )
        } );
      }

      if( el.href.startsWith( 'mailto:' ) ) {
        Analytics.fireEvent( 'Contact', 'Email Address Click', el.href.substring( 7 ) );
        Facebook.fireEvent( 'track', 'Contact', {
          content_category: 'Email Address Click',
          content_name: el.href.substring( 7 )
        } );
      }

      var extension = getLinkExtension( el.href );
      if( extension.length > 0 ) {
        for ( i = 0; i < extensions.length; ++i ) {
          if ( extensions[i] === extension) {
            Analytics.fireEvent( 'File', 'Download', getLinkFilename( el.href ) );
            Facebook.fireEvent( 'track', 'ViewContent', {
              content_category: 'Download',
              content_name: getLinkFilename( el.href ),
            } );
          }
        }
      }
    }
  } );

  if( typeof mc4wp != "undefined" ) {
    mc4wp.forms.on( 'subscribed', function( form ) {
      Analytics.fireEvent( 'Newsletter', 'Subscription', form.id );
      Facebook.fireEvent( 'track', 'CompleteRegistration', {
        content_category: 'Newsletter',
        content_name: form.id
      } );
    } );
  }
} ) ();

window.onload = function() {
  //handles analytics for jQuery-fired events that can't be captured with vanilla js
  if( typeof jQuery === 'function' ) {
    jQuery( document ).on( 'nfFormSubmitResponse', function( event, response, id ) {
      Analytics.fireEvent( 'Contact', 'Form Submission', response.response.data.form_id );
      Facebook.fireEvent( 'track', 'Contact', {
        content_category: 'Form Submission',
        content_name: response.response.data.form_id
      } );
    });
  }
}
