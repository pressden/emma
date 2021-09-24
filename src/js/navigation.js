/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

var toggle, closer, closers, drawer, clones;
drawer = document.getElementById("menu-drawer");

(function () {
	var mainMenus, utilityMenus, container, menu, links, i, len;

	toggle = document.getElementById("menu-opener");
	closer = document.getElementById("menu-closer");
	closers = document.querySelectorAll(".drawer-closer");
	clones = document.getElementById("menu-clones");

	mainMenus = document.querySelectorAll(
		"#masthead .site-navigation, #main-navigation"
	);

	utilityMenus = document.querySelectorAll(
		"#masthead .widget_nav_menu"
	);

	// Exit early if collection is empty or the toggle button is undefined
	if ((mainMenus.length === 0 && utilityMenus.length === 0) || "undefined" === typeof toggle) {
		return;
	}

	toggle.onclick = function () {
		if (!drawer.classList.contains("toggled")) {
			openMenuDrawer();
		} else {
			closeMenuDrawer();
		}
	};

	closers.forEach((closer) => {
		closer.addEventListener("click", function (event) {
			event.preventDefault();
			closeMenuDrawer();
		})
	});

	let autoMenus = drawer.querySelector( '.auto-populate' );
	if( autoMenus ) {
		copyMenuItems(mainMenus, "tier-1");
		copyMenuItems(utilityMenus, "tier-2");
	}

	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.addEventListener("click", function (event) {
			event.preventDefault();
			item.setAttribute("aria-expanded", "true");
			let subMenu = item.nextElementSibling;
			subMenu.classList.add("active");
		});
	});

	drawer.querySelectorAll(".sub-menu").forEach((item) => {
		let subMenuTitleLink = item.previousElementSibling.cloneNode(true);
		if(subMenuTitleLink.attributes['href'].value === "#") {
			subMenuTitleLink.classList.add("inactive");
			subMenuTitleLink.tabIndex = -1;
		}
		let subMenuTitleListItem = document.createElement("li");
		subMenuTitleListItem.classList.add("menu-item", "menu-title");
		subMenuTitleListItem.appendChild(subMenuTitleLink);

		item.insertAdjacentHTML('afterbegin', '<li class="menu-item sub-menu-back menu-back"><a href="#">Previous Menu</a></li>');
		item.prepend(subMenuTitleListItem);
	});

	drawer.querySelectorAll(".sub-menu-back a").forEach((item) => {
		item.addEventListener("click", function (event) {
			event.preventDefault();
			let subMenu = item.closest(".sub-menu");
			let subMenuToggle = subMenu.previousElementSibling;
			subMenu.classList.remove("active");
			subMenuToggle.setAttribute("aria-expanded", "false");
		});
	});

	// Get all the link elements within the menu.
	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		//stops focus from being given (and thus menu from appearing) before click event is registered
		item.addEventListener("mousedown", function (event) {
			event.preventDefault();
		});
		item.addEventListener("click", function (event) {
			if (
				!this.closest(".menu-item-has-children").classList.contains("focus")
			) {
				event.preventDefault();
				this.focus();
			}
		});
	});

	// drawer.addEventListener("focusout", function (event) {
	// 	if (!drawer.contains(event.relatedTarget)) {
	// 		closer.focus();
	// 	}
	// });
})();

function openMenuDrawer() {
	document.body.classList.add("menu-drawer-open");
	closer.focus();
	trapFocus(drawer);
}

function closeMenuDrawer() {
	releaseFocus(drawer);
	document.body.classList.remove("menu-drawer-open");
	drawer.querySelectorAll(".sub-menu.active").forEach((item) => {
		item.classList.remove("active");
	});
	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.setAttribute("aria-expanded", "false");
	});
	toggle.focus();
}

function copyMenuItems( menus, defaultLocation ) {
	menus.forEach((menu) => {
		let links = menu.querySelectorAll("a");

		links.forEach((link) => {
			let copyLocation = defaultLocation;
			
			if(link.dataset.menuDrawerLocation) {
				copyLocation = link.dataset.menuDrawerLocation;
			}

			let clone = link.closest("li").cloneNode(true);
			if( clone.id ) {
				clone.id = clone.id + "-drawer";
			}
			let copyLocationEl = drawer.querySelector("." + copyLocation);
			if( copyLocationEl ) {
				copyLocationEl.appendChild(clone);
			}
		});
	});
}

function trapFocus(element) {
  let allFocusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
	var focusableEls = Array();
	allFocusableEls.forEach((el) => {
		var style = window.getComputedStyle(el, null);

		if( style.visibility == "visible" ) {
			focusableEls.push( el );
		}
	});
  var firstFocusableEl = focusableEls[0];  
  var lastFocusableEl = focusableEls[focusableEls.length - 1];

  element.addEventListener('keydown', checkFocusChange, false);
	element.firstFocusableEl = firstFocusableEl;
	element.lastFocusableEl = lastFocusableEl;
}

function checkFocusChange(e) {
	let firstFocusableEl = e.currentTarget.firstFocusableEl;
	let lastFocusableEl = e.currentTarget.lastFocusableEl;
	var KEYCODE_TAB = 9;
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
}

function releaseFocus(element) {
	element.removeEventListener('keydown', checkFocusChange);
}
