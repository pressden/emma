/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

import { trapFocus, releaseFocus } from './utility';

let drawer, currentMenu, topLevelMenus, subMenus, menuBack, openers, clones;
drawer = document.querySelector("#flyout-menu");

(function () {
	let mainMenus, utilityMenus, closers, autoMenus, background;

	clones = document.querySelector(".menu-clones");
	openers = document.querySelectorAll(".flyout-menu-opener a");
	closers = document.querySelectorAll(".menu-closer");
	background = document.querySelector(".flyout-menu-background");
	topLevelMenus = drawer.querySelector("#top-level-menus");
	menuBack = drawer.querySelector(".menu-back a");
	currentMenu = topLevelMenus;
	autoMenus = drawer.querySelector( '.auto-populate' );

	// automatically populate menus if appropriate
	if( autoMenus ) {
		mainMenus = document.querySelectorAll(
			"#masthead .site-navigation, #main-navigation"
		);

		utilityMenus = document.querySelectorAll(
			"#mastutils .widget_nav_menu"
		);

		copyMenuItems(mainMenus, "tier-1");
		copyMenuItems(utilityMenus, "tier-2");
	}

	// assign our subMenus variable *after* copying menus
	subMenus = drawer.querySelectorAll('.sub-menu');

	// set opener and closer event listeners
	openers.forEach((opener) => {
		opener.setAttribute("aria-controls", "flyout-menu");
		opener.setAttribute("aria-expanded", "false");
		opener.addEventListener("click", function (event) {
			openMenuDrawer();
		});
	});

	closers.forEach((closer) => {
		closer.addEventListener("click", function (event) {
			event.preventDefault();
			closeMenuDrawer();
		});
	});

	// configure click handler for menu back button (close or previous menu depending on context)
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
			setFocusTrapIgnore(topLevelMenus);
			trapFocus(drawer, menuBack);
			clones.style.height = parentMenu.offsetHeight + "px";
		}
	});

	// submenu reformatting
	drawer.querySelectorAll(".menu-item-has-children").forEach((menuItem) => {
		let subMenuLink = menuItem.querySelector("a");
		let subMenuId = subMenuLink.dataset.subMenuId;
		let subMenu = subMenuLink.nextElementSibling;
		let parentMenu = menuItem.closest(".sub-menu, .top-level-menus");

		// clone submenu parent link and add as submenu title
		let subMenuLinkClone = subMenuLink.cloneNode(true);
		subMenuLinkClone.removeAttribute("aria-haspopup");
		subMenuLinkClone.removeAttribute("aria-expanded");
		var subMenuLinkCloneListItem = document.createElement("li");
		subMenuLinkCloneListItem.classList.add("menu-title");
		if(subMenuLinkClone.attributes['href'].value === "#") {
			subMenuLinkCloneListItem.classList.add("inactive");
			subMenuLinkClone.tabIndex = -1;
		}
		subMenuLinkCloneListItem.appendChild(subMenuLinkClone);
		subMenu.prepend(subMenuLinkCloneListItem);

		// update submenu id and add parent menu data attribute, then move to menu clones container
		subMenu.id = "sub-menu-" + subMenuId;
		subMenu.dataset.parentMenuId = parentMenu.id;
		clones.appendChild(subMenu);

		// add event listener to submenu links to open submenus
		subMenuLink.addEventListener("click", function (event) {
			event.preventDefault();
			subMenu.classList.add("active");
			parentMenu.classList.add("sub-menu-open");
			clones.style.height = subMenu.offsetHeight + "px";
			currentMenu = subMenu;
			updateMenuBack();
			setFocusTrapIgnore(subMenu);
			trapFocus(drawer, menuBack);
		});
	});

	// set initial height of top menus container
	setInitialMenuClonesHeight();
})();

function openMenuDrawer() {
	document.body.classList.add("flyout-menu-open");
	setFocusTrapIgnore(topLevelMenus);
	trapFocus(drawer);
	openers.forEach((opener) => {
		opener.setAttribute("aria-expanded", "true");
	});
}

function closeMenuDrawer() {
	releaseFocus(drawer);
	document.body.classList.remove("flyout-menu-open");
	drawer.querySelectorAll(".sub-menu.active").forEach((item) => {
		item.classList.remove("active");
	});
	drawer.querySelectorAll(".sub-menu-open").forEach((item) => {
		item.classList.remove("sub-menu-open");
	});
	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.setAttribute("aria-expanded", "false");
	});
	currentMenu = topLevelMenus;
	updateMenuBack();
	setInitialMenuClonesHeight();
	openers.forEach((opener) => {
		opener.setAttribute("aria-expanded", "false");
	});
	openers[0].focus();
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
		let links = menu.querySelectorAll(".menu > .menu-item > a");

		links.forEach((link) => {
			let copyLocation = defaultLocation;

			if(link.dataset.menuDrawerLocation) {
				copyLocation = link.dataset.menuDrawerLocation;
			}

			let toClone = link.closest("li");
			if( ! toClone.classList.contains("flyout-menu-opener") ) {
				let clone = toClone.cloneNode(true);
				if( clone.id ) {
					clone.id = clone.id + "-drawer";
				}
				let copyLocationEl = drawer.querySelector("." + copyLocation);
				if( copyLocationEl ) {
					copyLocationEl.appendChild(clone);
				}
			}
		});
	});
}

function setInitialMenuClonesHeight() {
	clones.style.height = topLevelMenus.offsetHeight + "px";
}

function setFocusTrapIgnore( focusMenu ) {
	topLevelMenus.classList.add( 'focus-trap-ignore' );
	subMenus.forEach((subMenu) => {
		subMenu.classList.add( 'focus-trap-ignore' );
	});
	focusMenu.classList.remove( 'focus-trap-ignore' );
}
