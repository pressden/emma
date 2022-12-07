/**
 * COLUMN SIZER FUNCTIONS
 */

let $ = jQuery;

$(function () {
	$productsList = $("ul.products");
	$productsListClasses = $productsList.attr("class");

	if ($productsListClasses) {
		var defaultColumnSize = $productsListClasses.split(/\s+/)[1];
	} else {
		defaultColumnSize = "";
	}

	var currentColumnSize = defaultColumnSize;
	var selectedColumnSize = localStorage.getItem("column_size");
	if (selectedColumnSize != null && selectedColumnSize != currentColumnSize) {
		changeColumnSize($productsList, defaultColumnSize, selectedColumnSize);
		currentColumnSize = localStorage.getItem("column_size");
	}

	$(".woocommerce-columns-sizer a").click(function (e) {
		e.preventDefault();

		var newColumnSize = $(this).data("size");

		if (currentColumnSize != newColumnSize) {
			changeColumnSize($productsList, currentColumnSize, newColumnSize);
			currentColumnSize = newColumnSize;
			localStorage.setItem("column_size", "columns-" + newColumnSize.slice(-1));
		}
	});
});

function changeColumnSize($productsList, currentColumnSize, newColumnSize) {
	$productsList.removeClass(currentColumnSize);
	$productsList.addClass(newColumnSize);

	$(".woocommerce-columns-sizer.active").removeClass("active");
	$(".woocommerce-columns-sizer." + newColumnSize).addClass("active");
}

/**
 * MINI-CART FUNCTIONS
 */

function hideMiniCart() {
	if ($("#mini-cart").is(":visible")) {
		$("#mini-cart").addClass("d-none");
	}
}

var $activeToggle = "";

$(function () {
	$(".mini-cart-toggle").keydown(function (e) {
		var key = e.keyCode ? event.keyCode : event.which;
		if (key == "13") {
			window.location.href = "/cart";
			return false;
		}
	});

	$(document).on("click", ".mini-cart-toggle > a", function (e) {
		e.preventDefault();

		$activeToggle = $(this);
		var $miniCart = $("#mini-cart");

		if ($miniCart.is(":visible") || $('body').hasClass("flyout-menu-open")) {
			window.location.href = "/cart";
			return false;
		}

		relocateMiniCart($miniCart);
		e.stopPropagation();
	});

	$(window).resize(function () {
		var $miniCart = $("#mini-cart");

		if ($miniCart.is(":visible")) {
			relocateMiniCart($miniCart);
		}
	});

	$("#mini-cart-close").click(function (e) {
		e.preventDefault();
		hideMiniCart();
	});

	$("html").click(function (e) {
		var $target = $(e.target);

		if (
			!$target.closest(".mini-cart-toggle").length &&
			!$target.closest("#mini-cart").length
		) {
			hideMiniCart();
		}
	});

	document.addEventListener( 'focus', function() {
		let newFocus = document.activeElement;
		if (
			!$(newFocus).hasClass(".mini-cart-toggle") &&
			!$(newFocus).closest("#mini-cart").length
		) {
			hideMiniCart();
		}
	}, true );
});

function relocateMiniCart($miniCart) {
	var docHeight = $(document).outerHeight(true);
	var docWidth = $(document).outerWidth(true);
	var viewportHeight = $(window).height();

	// keep minicart invisible but allow it to display as block so dimensions can be properly computed
	$miniCart.css("visibility", "hidden");
	$miniCart.removeClass("d-none");

	var miniCartWidth = $miniCart.outerWidth(true);
	var miniCartHeight = $miniCart.outerHeight(true);

	// set back to display:none after computing dimensions to make sure page flow isn't messed with
	$miniCart.addClass("d-none");
	$miniCart.css("visibility", "visible");

	var toggleHeight = $activeToggle.outerHeight(true);
	var toggleWidth = $activeToggle.outerWidth();
	var toggleTop = $activeToggle.offset().top;
	var toggleBottom = toggleTop + toggleHeight;
	var toggleLeft = $activeToggle.offset().left;
	var toggleRight = toggleLeft + toggleWidth;
	var toggleCenter = toggleLeft + toggleWidth / 2;

	if (miniCartWidth < docWidth - 50) {
		if (toggleLeft + miniCartWidth < docWidth) {
			$miniCart.css("left", toggleLeft);
		} else if (toggleRight - miniCartWidth > 0) {
			$miniCart.css("left", toggleLeft - miniCartWidth + toggleWidth);
		} else if (
			toggleCenter - miniCartWidth / 2 > 0 &&
			toggleCenter + miniCartWidth / 2 < docWidth
		) {
			$miniCart.css("left", toggleLeft + miniCartWidth / -2 + toggleWidth / 2);
		} else {
			window.location.href = "/cart";
			return false;
		}
	} else {
		window.location.href = "/cart";
		return false;
	}

	if (
		toggleBottom + miniCartHeight < docHeight &&
		miniCartHeight < viewportHeight - 50
	) {
		$miniCart.css("top", toggleBottom + 4);
	} else if (
		toggleTop - miniCartHeight > 0 &&
		miniCartHeight < viewportHeight - 50
	) {
		$miniCart.css("top", -miniCartHeight + toggleTop - 4);
	} else {
		window.location.href = "/cart";
		return false;
	}

	$("#mini-cart a").attr("tabindex", "-1");
	$miniCart.removeClass("d-none");
}
