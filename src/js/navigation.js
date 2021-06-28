/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

var toggle, closer, drawer, clones;

(function () {
	var collection, container, menu, links, i, len;

	toggle = document.getElementById("menu-opener");
	closer = document.getElementById("menu-closer");
	drawer = document.getElementById("menu-drawer");
	clones = document.getElementById("menu-clones");

	collection = document.querySelectorAll(
		"#masthead .site-navigation, #masthead .widget_nav_menu, #main-navigation"
	);

	// Exit early if collection is empty or the toggle button is undefined
	if (collection.length === 0 || "undefined" === typeof toggle) {
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

	closer.addEventListener("blur", function (event) {
		if (!drawer.contains(event.relatedTarget)) {
			closeMenuDrawer();
		}
	});

	collection.forEach((container) => {
		menu = container.querySelector("ul");

		// put a clone of the menu in the menu clones container
		let clone = menu.cloneNode(true);
		clones.appendChild(clone);

		if (-1 === menu.className.indexOf("nav-menu")) {
			menu.className += " nav-menu";
		}
	});

	clones.querySelectorAll("*").forEach((item) => {
		if (item.id) {
			item.id = item.id + "-drawer";
		}
	});

	document.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.addEventListener("touchend", function (event) {
			if (item !== document.activeElement) {
				item.focus();
				event.preventDefault();
			}
		});
	});

	// Get all the link elements within the menu.
	drawer.querySelectorAll(".menu-item-has-children > a").forEach((item) => {
		item.addEventListener("focus", function (event) {
			toggleFocus(this);
		});
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
		var target = event.target;
		var menuParent = target.closest(".menu-item-has-children");
		if (menuParent) {
			if (!menuParent.contains(event.relatedTarget)) {
				menuParent.classList.remove("focus");
			}
		}

		if (!drawer.contains(event.relatedTarget)) {
			closer.focus();
		}
	});
})();

function openMenuDrawer() {
	drawer.querySelectorAll("a").forEach((item) => {
		item.tabIndex = 0;
	});
	drawer.classList.add("toggled");
	closer.focus();
}

function closeMenuDrawer() {
	drawer.querySelectorAll("a").forEach((item) => {
		item.tabIndex = -1;
	});
	drawer.classList.remove("toggled");
	toggle.focus();
}

/**
 * Sets or removes .focus class on an element.
 */
function toggleFocus(menuItem) {
	drawer.querySelectorAll(".focus").forEach(
		(focusItem) =>
			function () {
				focusItem.classList.remove("focus");
			}
	);
	menuItem.closest("li").classList.add("focus");
}
