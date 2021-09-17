/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

var toggle, closer, drawer, clones;
drawer = document.getElementById("menu-drawer");

(function () {
	var mainMenus, utilityMenus, container, menu, links, i, len;

	toggle = document.getElementById("menu-opener");
	closer = document.getElementById("menu-closer");
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

	closer.onclick = function () {
		closeMenuDrawer();
	};

	copyMenuItems(mainMenus, "tier-1");
	copyMenuItems(utilityMenus, "tier-2");

	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.addEventListener("click", function (event) {
			event.preventDefault();
			let sibling = item.nextElementSibling;
			sibling.classList.add("active");
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

		item.insertAdjacentHTML('afterbegin', '<li class="menu-item sub-menu-back"><a href="#">Back</a></li>');
		item.prepend(subMenuTitleListItem);
	});

	drawer.querySelectorAll(".sub-menu-back a").forEach((item) => {
		item.addEventListener("click", function (event) {
			event.preventDefault();
			let subMenu = item.closest(".sub-menu");
			subMenu.classList.remove("active");
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

	drawer.addEventListener("focusout", function (event) {
		if (!drawer.contains(event.relatedTarget)) {
			closer.focus();
		}
	});
})();

function openMenuDrawer() {
	drawer.classList.add("toggled");
	closer.focus();
}

function closeMenuDrawer() {
	drawer.classList.remove("toggled");
	drawer.querySelectorAll(".sub-menu.active").forEach((item) => {
		item.classList.remove("active");
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
