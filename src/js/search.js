/**
 * File search.js.
 *
 * Relocates and displays the search form when a toggle is clicked or focused
 */

var searchForm;

(function () {
	searchForm = document.querySelector(".floating-search-form");

	document.querySelectorAll(".search-form-toggle").forEach((toggle) => {
		var toggleLink = toggle.querySelector("a");
		toggleLink.addEventListener("click", (event) => {
			event.preventDefault();
			if (searchForm.classList.contains("d-none")) {
				relocateSearch(toggle);
			} else {
				hideSearchForm();
			}
		});
		toggleLink.addEventListener("blur", (event) => {
			if (
				event.relatedTarget != null &&
				!searchForm.contains(event.relatedTarget)
			) {
				hideSearchForm();
			}
		});
	});

	document.querySelectorAll(".floating-search-form input").forEach((input) => {
		input.addEventListener("blur", (event) => {
			if (
				event.relatedTarget != null &&
				!searchForm.contains(event.relatedTarget) &&
				!searchForm
					.closest(".search-form-toggle")
					.contains(event.relatedTarget)
			) {
				hideSearchForm();
			}
		});
	});

	document.addEventListener("click", (event) => {
		if (!searchForm.classList.contains("d-none")) {
			if (
				!event.target.parentElement.classList.contains("search-form-toggle") &&
				!event.target.classList.contains("floating-search-form") &&
				!searchForm.contains(event.target)
			) {
				hideSearchForm();
			}
		}
	});
})();

function relocateSearch(toggle) {
	toggle.appendChild(searchForm);

	searchForm.classList.remove("d-none");
	var searchFormRect = searchForm.getBoundingClientRect();
	searchForm.classList.add("d-none");

	var documentWidth = document.body.clientWidth;
	var documentHeight = document.body.clientHeight;
	var toggleRect = toggle.getBoundingClientRect();

	// Default search form alignment is left:0 flowing right.
	if ( searchFormRect.width < documentWidth - toggleRect.x ) {
		// Nothing to do for the default behavior.
	}
	// Alternate search form alignment is right:0 flowing left.
	else if ( searchFormRect.width < toggleRect.x + toggleRect.width ) {
		searchForm.style.right = 0;
	}
	// On narrow screens display the search form edge to edge.
	else {
		//searchForm.style.width = '100vw';
		searchForm.style.left  = ( - toggleRect.x ) + 'px';
	}

	if ( documentHeight < toggleRect.bottom + window.pageYOffset + searchFormRect.height ) {
		searchForm.style.top = -searchFormRect.height - 4 + "px";
	} else {
		searchForm.style.top = toggleRect.height + 4 + "px";
	}

	searchForm.classList.remove("d-none");
	searchForm.querySelector('input[type="search"]').focus();
}

function hideSearchForm() {
	searchForm.classList.add("d-none");
}
