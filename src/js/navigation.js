/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
  var collection, container, drawer, clones, toggle, closer, menu, links, i, len;

  toggle = document.getElementById( 'menu-toggle' );
  closer = document.getElementById( 'menu-closer' );
  drawer = document.getElementById( 'menu-drawer' );
  clones = document.getElementById( 'menu-clones' );

  // @TODO: Evaluate performance with querySelectorAll vs. getElementById or getElementsByClassName
  collection = document.querySelectorAll( '#masthead .site-navigation, #masthead .widget_nav_menu, #main-navigation' );

  // Exit early if collection is empty of the toggle button is undefined
	if ( collection.legth === 0 || 'undefined' === typeof toggle ) {
		return;
  }

  for( let container of collection ) {
    menu = container.getElementsByTagName( 'ul' )[0];

    // @TODO: Move this outside the for loop since one toggle button controls multiple menus
    /*
    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof menu ) {
      toggle.style.display = 'none';
      return;
    }
    */

    // continue if the menu is empty
    if ( 'undefined' === typeof menu ) {
      continue;
    }

    // put a clone of the menu in the menu clones container
    let clone = menu.cloneNode( true );
    clones.appendChild( clone );

    menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
      menu.className += ' nav-menu';
    }

    toggle.onclick = function() {
      if ( -1 !== drawer.className.indexOf( 'toggled' ) ) {
        drawer.className = drawer.className.replace( ' toggled', '' );
        toggle.setAttribute( 'aria-expanded', 'false' );
        menu.setAttribute( 'aria-expanded', 'false' );
      } else {
        drawer.className += ' toggled';
        toggle.setAttribute( 'aria-expanded', 'true' );
        menu.setAttribute( 'aria-expanded', 'true' );
      }
    };

    closer.onclick = function() {
      drawer.className = drawer.className.replace( ' toggled', '' );
      toggle.setAttribute( 'aria-expanded', 'false' );
      menu.setAttribute( 'aria-expanded', 'false' );
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( i = 0, len = links.length; i < len; i++ ) {
      links[i].addEventListener( 'focus', toggleFocus, true );
      links[i].addEventListener( 'blur', toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
      var self = this;

      // Move up through the ancestors of the current link until we hit .nav-menu.
      while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

        // On li elements toggle the class .focus.
        if ( 'li' === self.tagName.toLowerCase() ) {
          if ( -1 !== self.className.indexOf( 'focus' ) ) {
            self.className = self.className.replace( ' focus', '' );
          } else {
            self.className += ' focus';
          }
        }

        self = self.parentElement;
      }
    }
  }

  /**
   * Toggles `focus` class to allow submenu access on tablets.
   */
  ( function( collection ) {
    for( let container of collection ) {
      var touchStartFn, i,
        parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

      if ( 'ontouchstart' in window ) {
        touchStartFn = function( e ) {
          var menuItem = this.parentNode, i;

          if ( ! menuItem.classList.contains( 'focus' ) ) {
            e.preventDefault();
            for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
              if ( menuItem === menuItem.parentNode.children[i] ) {
                continue;
              }
              menuItem.parentNode.children[i].classList.remove( 'focus' );
            }
            menuItem.classList.add( 'focus' );
          } else {
            menuItem.classList.remove( 'focus' );
          }
        };

        for ( i = 0; i < parentLink.length; ++i ) {
          parentLink[i].addEventListener( 'touchstart', touchStartFn );
        }
      }
    }
  }( collection ) );
} )();
