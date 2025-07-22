function getSiblings( el ) {
	return Array.prototype.filter.call(el.parentNode.children, function (sibling) {
		return sibling !== el;
	} );
};

function trapFocus( inertEls, elToFocus = false ) {
  inertEls.forEach( ( el ) => {
    el.inert = true;
  } );

  if ( elToFocus ) {
    elToFocus.focus();
  }
}

function releaseFocus( inertEls, elToFocus = false ) {
  inertEls.forEach( ( el ) => {
    el.inert = false;
  } );

  if ( elToFocus ) {
    elToFocus.focus();
  }
}

function focusAfterAnimation( animatedEl, elToFocus ) {
  animatedEl.addEventListener( 'transitionend', function faa() {
    elToFocus.focus();
    this.removeEventListener( 'transitionend', faa );
  } );
}

function getSiblings( el ) {
	return Array.prototype.filter.call(el.parentNode.children, function (sibling) {
		return sibling !== el;
	} );
};