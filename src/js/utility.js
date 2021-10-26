(function () {
	document.addEventListener("click", function (event) {
		var link_extend = event.target.closest(".link-extend");
		if (link_extend) {
			var anchor = link_extend.querySelector("a");
			if (anchor) {
				anchor.click();
			}
		}
	});

  document.querySelectorAll( 'a[href="#"]' ).forEach((link) => {
		link.addEventListener("click", function (e) {
			e.preventDefault ? e.preventDefault() : e.returnValue = false;
		})
	});
})();

export function trapFocus(element, setFocus = false, delay = 0) {
	releaseFocus();
	element.classList.add("focus-trapped");
	let focusableEls = element.querySelectorAll('a[href]:not([disabled]):not(.inactive), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
	let trapEls = Array();
	focusableEls.forEach((el) => {
		let focusTrapIgnored = el.closest(".focus-trap-ignore");
		if( focusTrapIgnored === null && !el.classList.contains("focus-trap-ignore") ) {
			trapEls.push( el );
		}
	});

	let firstFocusableEl = trapEls[0];  
	if( !setFocus ) {
		setFocus = firstFocusableEl;
	}
	let lastFocusableEl = trapEls[trapEls.length - 1];
	
	element.addEventListener('keydown', checkFocusChange, false);
	element.firstFocusableEl = firstFocusableEl;
	element.lastFocusableEl = lastFocusableEl;

	setTimeout(function() {
		setFocus.focus();
	}, delay);
}

export function checkFocusChange(e) {
	let firstFocusableEl = e.currentTarget.firstFocusableEl;
	let lastFocusableEl = e.currentTarget.lastFocusableEl;
	let KEYCODE_TAB = 9;
	let isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	if (!isTabPressed) { 
		return; 
	}

	if ( e.shiftKey ) /* shift + tab */ {
		if (document.activeElement === firstFocusableEl) {
			lastFocusableEl.focus();
			e.preventDefault();
		}
	} else /* tab */ {
		if (document.activeElement === lastFocusableEl) {
			firstFocusableEl.focus();
			e.preventDefault();
		}
	}
}

export function releaseFocus() {
	let focusTrappedEl = document.querySelector(".focus-trapped");
	if(focusTrappedEl) {
		focusTrappedEl.classList.remove("focus-trapped");
		focusTrappedEl.removeEventListener('keydown', checkFocusChange);
	}
}
