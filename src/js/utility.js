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

function trapFocus(element) {
  var focusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
  var firstFocusableEl = focusableEls[0];  
  var lastFocusableEl = focusableEls[focusableEls.length - 1];
  var KEYCODE_TAB = 9;

  element.addEventListener('keydown', function(e) {
    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

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
  });
}
