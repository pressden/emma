/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

var toggle, closer, drawer, topLevelMenus, menuBack, currentMenu;
drawer = document.getElementById("flyout-menu");

(function () {
	var mainMenus, utilityMenus, container, menu, links, i, len;

	clones = document.querySelector(".menu-clones");
	toggle = document.getElementById("menu-opener");
	closer = document.getElementById("menu-closer");
	topLevelMenus = document.querySelector("#top-level-menus");
	menuBack = drawer.querySelector(".menu-back a");
	currentMenu = topLevelMenus;

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

	closer.addEventListener("click", function (event) {
		event.preventDefault();
		closeMenuDrawer();
	});

	menuBack.addEventListener("click", function(event) {
		event.preventDefault();
		if(currentMenu == topLevelMenus) {
			closeMenuDrawer();
		} else {
			let parentMenuId = currentMenu.dataset.parentMenuId;
			let parentMenu = drawer.querySelector("#" + parentMenuId);
			currentMenu.classList.remove("active");
			parentMenu.classList.remove("sub-menu-open");
			currentMenu = parentMenu;
			updateMenuBack();
			trapFocus(drawer, 0, menuBack);
			clones.style.height = parentMenu.offsetHeight + "px";
		}
	});

	let autoMenus = drawer.querySelector( '.auto-populate' );
	if( autoMenus ) {
		copyMenuItems(mainMenus, "tier-1");
		copyMenuItems(utilityMenus, "tier-2");
	}

	drawer.querySelectorAll(".menu-item-has-children").forEach((menuItem) => {
		let subMenuLink = menuItem.querySelector("a");
		let subMenuId = subMenuLink.dataset.subMenuId;
		let subMenu = subMenuLink.nextElementSibling;
		let parentMenu = menuItem.closest(".sub-menu, .top-level-menus");


		let subMenuLinkClone = subMenuLink.cloneNode(true);
		subMenuLinkClone.removeAttribute("aria-haspopup");
		subMenuLinkClone.removeAttribute("aria-expanded");
		if(subMenuLinkClone.attributes['href'].value === "#") {
			subMenuLinkClone.classList.add("inactive");
			subMenuLinkClone.tabIndex = -1;
		}
		let subMenuLinkCloneListItem = document.createElement("li");
		subMenuLinkCloneListItem.classList.add("menu-title");
		subMenuLinkCloneListItem.appendChild(subMenuLinkClone);
		subMenu.prepend(subMenuLinkCloneListItem);

		subMenu.id = "sub-menu-" + subMenuId;
		subMenu.dataset.parentMenuId = parentMenu.id;
		clones.appendChild(subMenu);

		subMenuLink.addEventListener("click", function (event) {
			event.preventDefault();
			subMenu.classList.add("active");
			parentMenu.classList.add("sub-menu-open");
			clones.style.height = subMenu.offsetHeight + "px";
			currentMenu = subMenu;
			updateMenuBack();
			trapFocus(drawer, 0, menuBack);
			// previousMenu = subMenuLink.closest(".sub-menu, .menu");
			// previousMenu.scrollTop = 0;
			// previousMenu.classList.add("sub-menu-open");
			// subMenuLink.setAttribute("aria-expanded", "true");
			// let subMenu = subMenuLink.nextElementSibling;
			// subMenu.classList.add("active");
			// trapFocus(subMenu, 250);
		});
	});

	// drawer.querySelectorAll(".sub-menu").forEach((item) => {
	// 	let subMenuTitleLink = item.previousElementSibling.cloneNode(true);
	// 	subMenuTitleLink.removeAttribute("aria-haspopup");
	// 	subMenuTitleLink.removeAttribute("aria-expanded");
	// 	if(subMenuTitleLink.attributes['href'].value === "#") {
	// 		subMenuTitleLink.classList.add("inactive");
	// 		subMenuTitleLink.tabIndex = -1;
	// 	}
	// 	let subMenuTitleListItem = document.createElement("li");
	// 	subMenuTitleListItem.classList.add("menu-item", "menu-title");
	// 	subMenuTitleListItem.appendChild(subMenuTitleLink);

	// 	item.insertAdjacentHTML('afterbegin', '<li class="menu-item sub-menu-back menu-back"><a href="#">Previous Menu</a></li>');
	// 	item.prepend(subMenuTitleListItem);
	// });

	// drawer.querySelectorAll(".sub-menu-back a").forEach((item) => {
	// 	item.addEventListener("click", function (event) {
	// 		event.preventDefault();
	// 		let subMenu = item.closest(".sub-menu");
	// 		let subMenuToggle = subMenu.previousElementSibling;
	// 		let parentMenu = item.closest(".sub-menu-open");
	// 		subMenu.classList.remove("active");
	// 		parentMenu.classList.remove("sub-menu-open");
	// 		trapFocus(parentMenu, false);
	// 		subMenuToggle.setAttribute("aria-expanded", "false");
	// 		subMenuToggle.focus();
	// 	});
	// });

	clones.style.height = topLevelMenus.offsetHeight + "px";
})();

function openMenuDrawer() {
	document.body.classList.add("flyout-menu-open");
	trapFocus(drawer, 250);
}

function closeMenuDrawer() {
	releaseFocus(drawer);
	document.body.classList.remove("flyout-menu-open");
	drawer.querySelectorAll(".sub-menu.active").forEach((item) => {
		item.classList.remove("active");
	});
	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.setAttribute("aria-expanded", "false");
	});
	toggle.focus();
}

function updateMenuBack() {
	if( currentMenu == topLevelMenus ) {
		menuBack.innerHTML = "Close Menu";
	} else {
		menuBack.innerHTML = "Previous Menu";
	}
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

function trapFocus(element, focusDelay = 0, setFocus = false) {
	releaseFocus();
	element.classList.add("focus-trapped");
  let allFocusableEls = element.querySelectorAll('a[href]:not([disabled]):not(.inactive), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
	var focusableEls = Array();
	allFocusableEls.forEach((el) => {
		var style = window.getComputedStyle(el, null);

		if( style.visibility == "visible" ) {
			focusableEls.push( el );
		}
	});
  var firstFocusableEl = focusableEls[0];  
	if( !setFocus ) {
		setFocus = firstFocusableEl;
	}
	console.log(focusableEls);
  var lastFocusableEl = focusableEls[focusableEls.length - 1];
	
  element.addEventListener('keydown', checkFocusChange, false);
	element.firstFocusableEl = firstFocusableEl;
	element.lastFocusableEl = lastFocusableEl;

	if(focusDelay !== false) {
		setTimeout(function() {
			setFocus.focus();
		}, focusDelay);
	}
	
}

function checkFocusChange(e) {
	let firstFocusableEl = e.currentTarget.firstFocusableEl;
	let lastFocusableEl = e.currentTarget.lastFocusableEl;
	var KEYCODE_TAB = 9;
	var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

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

function releaseFocus() {
	focusTrappedEl = document.querySelector(".focus-trapped");
	if(focusTrappedEl) {
		focusTrappedEl.classList.remove("focus-trapped");
		focusTrappedEl.removeEventListener('keydown', checkFocusChange);
	}
}
