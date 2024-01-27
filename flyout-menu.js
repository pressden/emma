window.onload = ( event ) => {
	const flyoutMenu = document.querySelector( '#flyout-menu' );
		if ( ! flyoutMenu ) {
			return;
		}

	const summaryTags = flyoutMenu.querySelectorAll( 'summary' );
	const detailsTags = flyoutMenu.querySelectorAll( 'details' );
	const backButtons = flyoutMenu.querySelectorAll( 'details .menu-back' );
	const openers = document.querySelectorAll( '.flyout-menu-opener a' );
	const closers = document.querySelectorAll( '.flyout-menu-closer' );
	const inertEls = getSiblings( flyoutMenu.parentNode );

	openers.forEach( ( opener ) => {
		opener.setAttribute( 'aria-controls', 'flyout-menu' );
		opener.setAttribute( 'aria-expanded', 'false' );
		opener.addEventListener( 'click', function ( event ) {
			event.preventDefault();
			openMenuDrawer();
		} );
	} );

	closers.forEach( ( closer ) => {
		closer.addEventListener( 'click', function ( event ) {
			event.preventDefault();
			closeMenuDrawer();
		} );
	} );

	function openMenuDrawer() {
		setTimeout( () => {
			document.body.classList.add( 'flyout-menu-open' );
		});

		openers.forEach( ( opener ) => {
			opener.setAttribute( 'aria-expanded', 'true' );
		} );

		trapFocus( inertEls, document.querySelector( '.flyout-menu-closer.menu-back' ) );
	}

	function closeMenuDrawer() {
		detailsTags.forEach( ( detailsTag ) => {
			detailsTag.classList.remove( 'submenu-open' );
			setTimeout( () => {
				detailsTag.removeAttribute( 'open' );
			}, 50 );
		} );

		releaseFocus( inertEls );
		document.body.classList.remove( 'flyout-menu-open' );

		flyoutMenu.querySelectorAll( '.has-open-submenu' ).forEach( ( item ) => {
			item.classList.remove( 'has-open-submenu' );
		} );

		openers.forEach( ( opener ) => {
			opener.setAttribute( 'aria-expanded', 'false' );
		} );
	}

	summaryTags.forEach( ( summaryTag ) => {
		summaryTag.addEventListener('click', () => {
			let detailsElement = summaryTag.closest( 'details' );
			let parentMenu = detailsElement.closest( '.menu-container' );

			setTimeout( () => {
				detailsElement.classList.add( 'submenu-open' );
				parentMenu.classList.add( 'has-open-submenu' );
				focusAfterAnimation( detailsElement.querySelector( '.menu-back' ) );
			}, 50 );
		} );
	} );

	backButtons.forEach( ( backButton ) => {
		backButton.addEventListener( 'click', () => {
			let detailsElement = backButton.closest( 'details' );
			detailsElement.classList.remove( 'submenu-open' );

			let parentMenu = detailsElement.closest( '.menu-container' );
			parentMenu.classList.remove( 'has-open-submenu' );

			detailsCloseDelay( detailsElement );
			focusAfterAnimation( detailsElement.querySelector( 'summary' ) );
		} );
	} );

	function detailsCloseDelay( detailsElement ) {
		let animationStart;

		const handleAnimation = ( time ) => {
			if ( animationStart === undefined ) {
				animationStart = time;
			}

			const elapsedTime = time - animationStart;

			if ( elapsedTime < 300 ) {
				window.requestAnimationFrame( handleAnimation );
			} else {
				detailsElement.removeAttribute( 'open' );
			}
		};

		window.requestAnimationFrame( handleAnimation );
	}

	function focusAfterAnimation ( elToFocus ) {
		flyoutMenu.addEventListener( 'transitionend', function faa() {
			elToFocus.focus();
			this.removeEventListener( 'transitionend', faa );
		} );
	}

	function trapFocus( inertEls, elToFocus = false ) {
		inertEls.forEach( ( el ) => {
			el.inert = true;
		} );

		if ( elToFocus ) {
			focusAfterAnimation( elToFocus );
		}
	}

	function releaseFocus( inertEls, elToFocus = false ) {
		inertEls.forEach( ( el ) => {
			el.inert = false;
		} );

		if( elToFocus ) {
			elToFocus.focus();
		}
	}
};

function getSiblings( el ) {
	return Array.prototype.filter.call(el.parentNode.children, function (sibling) {
		return sibling !== el;
	} );
};
