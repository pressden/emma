/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

import { trapFocus, releaseFocus } from './utility';

let drawer, currentMenu, topLevelMenus, menuBack, opener, clones;
drawer = document.querySelector("#flyout-menu");

(function () {
	let mainMenus, utilityMenus, closers, autoMenus, background;

	clones = document.querySelector(".menu-clones");
	opener = document.querySelector("#menu-opener");
	closers = document.querySelectorAll(".menu-closer");
	background = document.querySelector(".flyout-menu-background");
	topLevelMenus = document.querySelector("#top-level-menus");
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

	// set opener and closer event listeners
	opener.onclick = function () {
			openMenuDrawer();
	};
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
			trapFocus(drawer, 0, menuBack);
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
		if(subMenuLinkClone.attributes['href'].value === "#") {
			subMenuLinkClone.classList.add("inactive");
			subMenuLinkClone.tabIndex = -1;
		}
		let subMenuLinkCloneListItem = document.createElement("li");
		subMenuLinkCloneListItem.classList.add("menu-title");
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
			trapFocus(drawer, 0, menuBack);
		});
	});

	// set initial height of top menus container
	setInitialMenuClonesHeight();
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
	drawer.querySelectorAll(".sub-menu-open").forEach((item) => {
		item.classList.remove("sub-menu-open");
	});
	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.setAttribute("aria-expanded", "false");
	});
	currentMenu = topLevelMenus;
	updateMenuBack();
	setInitialMenuClonesHeight();
	opener.focus();
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

function setInitialMenuClonesHeight() {
	clones.style.height = topLevelMenus.offsetHeight + "px";
}
