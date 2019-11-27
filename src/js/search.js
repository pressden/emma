/**
 * File search.js.
 *
 * Relocates and displays the search form when a toggle is clicked or focused
 */
( function() {
  var search_form = document.querySelector( '.toggle-search-form' );

  document.querySelectorAll( '.search-form-toggle' ).forEach( toggle => {
    var toggle_link = toggle.querySelector( 'a' );
    toggle_link.addEventListener( 'click', event => {
      event.preventDefault();
      relocateSearch( toggle );
    } );
    toggle_link.addEventListener( 'focus', event => {
      relocateSearch( toggle );
    } );
    toggle_link.addEventListener( 'blur', event => {
      if( event.relatedTarget != null && ! search_form.contains( event.relatedTarget ) ) {
        hideSearchForm();
      }
    } );
  } );

  document.querySelectorAll( '.toggle-search-form input' ).forEach( input => {
    input.addEventListener( 'blur', event => {
      if( event.relatedTarget != null && ! search_form.contains( event.relatedTarget ) && ! event.relatedTarget.classList.contains( '.search-form-toggle' ) ) {
        hideSearchForm();
      }
    } );
  } );

  document.addEventListener( 'click', event => {
    if( ! search_form.classList.contains( 'd-none' ) ) {
      if( ! event.target.parentElement.classList.contains( 'search-form-toggle' ) && ! event.target.classList.contains( 'toggle-search-form' ) && ! search_form.contains( event.target ) ) {
        hideSearchForm();
      }
    }
  } );

} )();

function relocateSearch( toggle ) {
  var search_form = document.querySelector( '.toggle-search-form' );

  search_form.classList.remove( 'd-none' );
  var search_form_rect = search_form.getBoundingClientRect();
  search_form.classList.add( 'd-none' );

  var document_width = document.body.clientWidth;
  var document_height = document.body.clientHeight;
  var toggle_rect = toggle.getBoundingClientRect();

  toggle.appendChild( search_form );

  if( document_width < toggle_rect.right + search_form_rect.width ) {
    search_form.style.left = -search_form_rect.width + toggle_rect.width + 'px';
  } else {
    search_form.style.left = 0;
  }

  if( document_height < toggle_rect.bottom + window.pageYOffset + search_form_rect.height ) {
    search_form.style.top = -search_form_rect.height - 4 + 'px';
  } else {
    search_form.style.top = toggle_rect.height + 4 + "px";
  }

  search_form.classList.remove( 'd-none' );
}

function hideSearchForm() {
  var search_form = document.querySelector( '.toggle-search-form' );
  search_form.classList.add( 'd-none' );
}
