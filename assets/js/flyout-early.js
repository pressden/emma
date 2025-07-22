let flyoutMenuState = 'uninitialized';
let flyoutSearchState = 'uninitialized';

document.addEventListener( 'click', ( event ) => {
  if( event.target.closest( '.flyout-search-opener' ) ) {
    event.preventDefault();
    if( flyoutSearchState == 'uninitialized' ) {
      flyoutSearchState = 'preopen';
    }
  } else if( event.target.closest( '.flyout-menu-opener' ) ) {
    event.preventDefault();
    if( flyoutMenuState == 'uninitialized' ) {
      flyoutMenuState = 'preopen';
    }
  }
} );