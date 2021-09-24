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
