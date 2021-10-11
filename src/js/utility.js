(function () {
	document.addEventListener("click", function (event) {
		var link_extend = event.target.closest(".link-extend");
		if (link_extend) {
			var anchor = link_extend.querySelector("a");
			if (anchor) {
				var href = anchor.getAttribute("href");
				var target = anchor.getAttribute("target");

				if (href) {
					if (target) {
						window.open(href, target);
					} else {
						window.location = anchor.getAttribute("href");
					}
				}
			}
		}
	});

  document.querySelectorAll( 'a[href="#"]' ).forEach((link) => {
		link.addEventListener("click", function (e) {
			e.preventDefault ? e.preventDefault() : e.returnValue = false;
		})
	});
})();

export function trapFocus(element, focusDelay = 0, setFocus = false) {
	releaseFocus();
	element.classList.add("focus-trapped");
  let allFocusableEls = element.querySelectorAll('a[href]:not([disabled]):not(.inactive), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
	let focusableEls = Array();
	allFocusableEls.forEach((el) => {
		let style = window.getComputedStyle(el, null);

		if( style.visibility == "visible" ) {
			focusableEls.push( el );
		}
	});
  let firstFocusableEl = focusableEls[0];  
	if( !setFocus ) {
		setFocus = firstFocusableEl;
	}
	console.log(focusableEls);
  let lastFocusableEl = focusableEls[focusableEls.length - 1];
	
  element.addEventListener('keydown', checkFocusChange, false);
	element.firstFocusableEl = firstFocusableEl;
	element.lastFocusableEl = lastFocusableEl;

	if(focusDelay !== false) {
		setTimeout(function() {
			setFocus.focus();
		}, focusDelay);
	}
}

export function checkFocusChange(e) {
	let firstFocusableEl = e.currentTarget.firstFocusableEl;
	let lastFocusableEl = e.currentTarget.lastFocusableEl;
	let KEYCODE_TAB = 9;
	let isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	if (!isTabPressed) { 
		return; 
	}
	console.log("tab pressed");

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
