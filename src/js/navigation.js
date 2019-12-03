/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

var toggle, closer, drawer, clones;

( function() {
  var collection, container, menu, links, i, len;

  toggle = document.getElementById( 'menu-toggle' );
  closer = document.getElementById( 'menu-closer' );
  drawer = document.getElementById( 'menu-drawer' );
  clones = document.getElementById( 'menu-clones' );

  collection = document.querySelectorAll( '#masthead .site-navigation, #masthead .widget_nav_menu, #main-navigation' );

  // Exit early if collection is empty or the toggle button is undefined
	if ( collection.length === 0 || 'undefined' === typeof toggle ) {
		return;
  }

  toggle.onclick = function() {
    if ( ! drawer.classList.contains( 'toggled' ) ) {
      openMenuDrawer();
    } else {
      closeMenuDrawer();
    }
  };

  closer.onclick = function() {
    closeMenuDrawer();
  };

  for( let container of collection ) {
    menu = container.querySelector( 'ul' );

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
  }

  // Get all the link elements within the menu.
  drawer.querySelectorAll( '.menu-item-has-children > a' ).forEach( item => {
    item.addEventListener( 'focus', function( event ) {
      toggleFocus( this );
    } );
    //stops focus from being given (and thus menu from appearing) before click event is registered
    item.addEventListener( 'mousedown', function( event ) {
      event.preventDefault();
    } );
    item.addEventListener( 'click', function( event) {
      if( ! this.closest( '.menu-item-has-children' ).classList.contains( 'focus' ) ) {
        event.preventDefault();
        this.focus();
      }
    } );
  } );

  drawer.querySelectorAll( '.menu-item > a' ).forEach( item => {
    item.addEventListener( 'blur', function( event ) {
      var menuParent = this.closest( '.menu-item-has-children' );
      if( menuParent ) {
        if ( ! menuParent.contains( event.relatedTarget ) ) {
          menuParent.classList.remove( 'focus' );
        }
      }
    } );
  } );
} )();

function openMenuDrawer() {
  drawer.classList.add( 'toggled' );
  toggle.setAttribute( 'aria-expanded', 'true' );
}

function closeMenuDrawer() {
  drawer.classList.remove( 'toggled' );
  toggle.setAttribute( 'aria-expanded', 'false' );
}

/**
 * Sets or removes .focus class on an element.
 */
function toggleFocus( menuItem ) {
  drawer.querySelectorAll( '.focus' ).forEach( focusItem => function() {
    alert('test');
    focusItem.classList.remove( 'focus' );
  } );
  menuItem.closest( 'li' ).classList.add( 'focus' );
}
