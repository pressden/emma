/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./js/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./js/index.js":
/*!*********************!*\
  !*** ./js/index.js ***!
  \*********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _sass_style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../sass/style.scss */ \"./sass/style.scss\");\n/* harmony import */ var _sass_style_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_sass_style_scss__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _navigation__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./navigation */ \"./js/navigation.js\");\n/* harmony import */ var _navigation__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_navigation__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./skip-link-focus-fix */ \"./js/skip-link-focus-fix.js\");\n/* harmony import */ var _skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_2__);\n\n\n\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9pbmRleC5qcz9lZTFjIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQTRCOztBQUVOO0FBQ1MiLCJmaWxlIjoiLi9qcy9pbmRleC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi4vc2Fzcy9zdHlsZS5zY3NzJztcblxuaW1wb3J0ICcuL25hdmlnYXRpb24nO1xuaW1wb3J0ICcuL3NraXAtbGluay1mb2N1cy1maXgnO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./js/index.js\n");

/***/ }),

/***/ "./js/navigation.js":
/*!**************************!*\
  !*** ./js/navigation.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * File navigation.js.\n *\n * Handles toggling the navigation menu for small screens and enables TAB key\n * navigation support for dropdown menus.\n */\n( function() {\n  var collection, container, drawer, clones, toggle, closer, menu, links, i, len;\n\n  toggle = document.getElementById( 'menu-toggle' );\n  closer = document.getElementById( 'menu-closer' );\n  drawer = document.getElementById( 'menu-drawer' );\n  clones = document.getElementById( 'menu-clones' );\n\n  // @TODO: Evaluate performance with querySelectorAll vs. getElementById or getElementsByClassName\n  collection = document.querySelectorAll( '.site-navigation,.widget_nav_menu' );\n\n  // Exit early if collection is empty of the toggle button is undefined\n\tif ( collection.legth === 0 || 'undefined' === typeof toggle ) {\n\t\treturn;\n  }\n\n  for( let container of collection ) {\n    menu = container.getElementsByTagName( 'ul' )[0];\n\n    // @TODO: Move this outside the for loop since one toggle button controls multiple menus\n    /*\n    // Hide menu toggle button if menu is empty and return early.\n    if ( 'undefined' === typeof menu ) {\n      toggle.style.display = 'none';\n      return;\n    }\n    */\n\n    // continue if the menu is empty\n    if ( 'undefined' === typeof menu ) {\n      continue;\n    }\n\n    // put a clone of the menu in the menu clones container\n    let clone = menu.cloneNode( true );\n    clones.appendChild( clone );\n\n    menu.setAttribute( 'aria-expanded', 'false' );\n    if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {\n      menu.className += ' nav-menu';\n    }\n\n    toggle.onclick = function() {\n      if ( -1 !== drawer.className.indexOf( 'toggled' ) ) {\n        drawer.className = drawer.className.replace( ' toggled', '' );\n        toggle.setAttribute( 'aria-expanded', 'false' );\n        menu.setAttribute( 'aria-expanded', 'false' );\n      } else {\n        drawer.className += ' toggled';\n        toggle.setAttribute( 'aria-expanded', 'true' );\n        menu.setAttribute( 'aria-expanded', 'true' );\n      }\n    };\n\n    closer.onclick = function() {\n      drawer.className = drawer.className.replace( ' toggled', '' );\n      toggle.setAttribute( 'aria-expanded', 'false' );\n      menu.setAttribute( 'aria-expanded', 'false' );\n    };\n\n    // Get all the link elements within the menu.\n    links = menu.getElementsByTagName( 'a' );\n\n    // Each time a menu link is focused or blurred, toggle focus.\n    for ( i = 0, len = links.length; i < len; i++ ) {\n      links[i].addEventListener( 'focus', toggleFocus, true );\n      links[i].addEventListener( 'blur', toggleFocus, true );\n    }\n\n    /**\n     * Sets or removes .focus class on an element.\n     */\n    function toggleFocus() {\n      var self = this;\n\n      // Move up through the ancestors of the current link until we hit .nav-menu.\n      while ( -1 === self.className.indexOf( 'nav-menu' ) ) {\n\n        // On li elements toggle the class .focus.\n        if ( 'li' === self.tagName.toLowerCase() ) {\n          if ( -1 !== self.className.indexOf( 'focus' ) ) {\n            self.className = self.className.replace( ' focus', '' );\n          } else {\n            self.className += ' focus';\n          }\n        }\n\n        self = self.parentElement;\n      }\n    }\n  }\n\n  /**\n   * Toggles `focus` class to allow submenu access on tablets.\n   */\n  ( function( collection ) {\n    for( let container of collection ) {\n      var touchStartFn, i,\n        parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );\n\n      if ( 'ontouchstart' in window ) {\n        touchStartFn = function( e ) {\n          var menuItem = this.parentNode, i;\n\n          if ( ! menuItem.classList.contains( 'focus' ) ) {\n            e.preventDefault();\n            for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {\n              if ( menuItem === menuItem.parentNode.children[i] ) {\n                continue;\n              }\n              menuItem.parentNode.children[i].classList.remove( 'focus' );\n            }\n            menuItem.classList.add( 'focus' );\n          } else {\n            menuItem.classList.remove( 'focus' );\n          }\n        };\n\n        for ( i = 0; i < parentLink.length; ++i ) {\n          parentLink[i].addEventListener( 'touchstart', touchStartFn );\n        }\n      }\n    }\n  }( collection ) );\n} )();\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9uYXZpZ2F0aW9uLmpzPzk1ODUiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLE9BQU87QUFDUDtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBLG9DQUFvQyxTQUFTO0FBQzdDO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQSxXQUFXO0FBQ1g7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0Esd0JBQXdCLHlDQUF5QztBQUNqRTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxXQUFXO0FBQ1g7QUFDQTtBQUNBOztBQUVBLG9CQUFvQix1QkFBdUI7QUFDM0M7QUFDQTtBQUNBO0FBQ0E7QUFDQSxHQUFHO0FBQ0gsQ0FBQyIsImZpbGUiOiIuL2pzL25hdmlnYXRpb24uanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIEZpbGUgbmF2aWdhdGlvbi5qcy5cbiAqXG4gKiBIYW5kbGVzIHRvZ2dsaW5nIHRoZSBuYXZpZ2F0aW9uIG1lbnUgZm9yIHNtYWxsIHNjcmVlbnMgYW5kIGVuYWJsZXMgVEFCIGtleVxuICogbmF2aWdhdGlvbiBzdXBwb3J0IGZvciBkcm9wZG93biBtZW51cy5cbiAqL1xuKCBmdW5jdGlvbigpIHtcbiAgdmFyIGNvbGxlY3Rpb24sIGNvbnRhaW5lciwgZHJhd2VyLCBjbG9uZXMsIHRvZ2dsZSwgY2xvc2VyLCBtZW51LCBsaW5rcywgaSwgbGVuO1xuXG4gIHRvZ2dsZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnbWVudS10b2dnbGUnICk7XG4gIGNsb3NlciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnbWVudS1jbG9zZXInICk7XG4gIGRyYXdlciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnbWVudS1kcmF3ZXInICk7XG4gIGNsb25lcyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnbWVudS1jbG9uZXMnICk7XG5cbiAgLy8gQFRPRE86IEV2YWx1YXRlIHBlcmZvcm1hbmNlIHdpdGggcXVlcnlTZWxlY3RvckFsbCB2cy4gZ2V0RWxlbWVudEJ5SWQgb3IgZ2V0RWxlbWVudHNCeUNsYXNzTmFtZVxuICBjb2xsZWN0aW9uID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCggJy5zaXRlLW5hdmlnYXRpb24sLndpZGdldF9uYXZfbWVudScgKTtcblxuICAvLyBFeGl0IGVhcmx5IGlmIGNvbGxlY3Rpb24gaXMgZW1wdHkgb2YgdGhlIHRvZ2dsZSBidXR0b24gaXMgdW5kZWZpbmVkXG5cdGlmICggY29sbGVjdGlvbi5sZWd0aCA9PT0gMCB8fCAndW5kZWZpbmVkJyA9PT0gdHlwZW9mIHRvZ2dsZSApIHtcblx0XHRyZXR1cm47XG4gIH1cblxuICBmb3IoIGxldCBjb250YWluZXIgb2YgY29sbGVjdGlvbiApIHtcbiAgICBtZW51ID0gY29udGFpbmVyLmdldEVsZW1lbnRzQnlUYWdOYW1lKCAndWwnIClbMF07XG5cbiAgICAvLyBAVE9ETzogTW92ZSB0aGlzIG91dHNpZGUgdGhlIGZvciBsb29wIHNpbmNlIG9uZSB0b2dnbGUgYnV0dG9uIGNvbnRyb2xzIG11bHRpcGxlIG1lbnVzXG4gICAgLypcbiAgICAvLyBIaWRlIG1lbnUgdG9nZ2xlIGJ1dHRvbiBpZiBtZW51IGlzIGVtcHR5IGFuZCByZXR1cm4gZWFybHkuXG4gICAgaWYgKCAndW5kZWZpbmVkJyA9PT0gdHlwZW9mIG1lbnUgKSB7XG4gICAgICB0b2dnbGUuc3R5bGUuZGlzcGxheSA9ICdub25lJztcbiAgICAgIHJldHVybjtcbiAgICB9XG4gICAgKi9cblxuICAgIC8vIGNvbnRpbnVlIGlmIHRoZSBtZW51IGlzIGVtcHR5XG4gICAgaWYgKCAndW5kZWZpbmVkJyA9PT0gdHlwZW9mIG1lbnUgKSB7XG4gICAgICBjb250aW51ZTtcbiAgICB9XG5cbiAgICAvLyBwdXQgYSBjbG9uZSBvZiB0aGUgbWVudSBpbiB0aGUgbWVudSBjbG9uZXMgY29udGFpbmVyXG4gICAgbGV0IGNsb25lID0gbWVudS5jbG9uZU5vZGUoIHRydWUgKTtcbiAgICBjbG9uZXMuYXBwZW5kQ2hpbGQoIGNsb25lICk7XG5cbiAgICBtZW51LnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAnZmFsc2UnICk7XG4gICAgaWYgKCAtMSA9PT0gbWVudS5jbGFzc05hbWUuaW5kZXhPZiggJ25hdi1tZW51JyApICkge1xuICAgICAgbWVudS5jbGFzc05hbWUgKz0gJyBuYXYtbWVudSc7XG4gICAgfVxuXG4gICAgdG9nZ2xlLm9uY2xpY2sgPSBmdW5jdGlvbigpIHtcbiAgICAgIGlmICggLTEgIT09IGRyYXdlci5jbGFzc05hbWUuaW5kZXhPZiggJ3RvZ2dsZWQnICkgKSB7XG4gICAgICAgIGRyYXdlci5jbGFzc05hbWUgPSBkcmF3ZXIuY2xhc3NOYW1lLnJlcGxhY2UoICcgdG9nZ2xlZCcsICcnICk7XG4gICAgICAgIHRvZ2dsZS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuICAgICAgICBtZW51LnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAnZmFsc2UnICk7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICBkcmF3ZXIuY2xhc3NOYW1lICs9ICcgdG9nZ2xlZCc7XG4gICAgICAgIHRvZ2dsZS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ3RydWUnICk7XG4gICAgICAgIG1lbnUuc2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcsICd0cnVlJyApO1xuICAgICAgfVxuICAgIH07XG5cbiAgICBjbG9zZXIub25jbGljayA9IGZ1bmN0aW9uKCkge1xuICAgICAgZHJhd2VyLmNsYXNzTmFtZSA9IGRyYXdlci5jbGFzc05hbWUucmVwbGFjZSggJyB0b2dnbGVkJywgJycgKTtcbiAgICAgIHRvZ2dsZS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuICAgICAgbWVudS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuICAgIH07XG5cbiAgICAvLyBHZXQgYWxsIHRoZSBsaW5rIGVsZW1lbnRzIHdpdGhpbiB0aGUgbWVudS5cbiAgICBsaW5rcyA9IG1lbnUuZ2V0RWxlbWVudHNCeVRhZ05hbWUoICdhJyApO1xuXG4gICAgLy8gRWFjaCB0aW1lIGEgbWVudSBsaW5rIGlzIGZvY3VzZWQgb3IgYmx1cnJlZCwgdG9nZ2xlIGZvY3VzLlxuICAgIGZvciAoIGkgPSAwLCBsZW4gPSBsaW5rcy5sZW5ndGg7IGkgPCBsZW47IGkrKyApIHtcbiAgICAgIGxpbmtzW2ldLmFkZEV2ZW50TGlzdGVuZXIoICdmb2N1cycsIHRvZ2dsZUZvY3VzLCB0cnVlICk7XG4gICAgICBsaW5rc1tpXS5hZGRFdmVudExpc3RlbmVyKCAnYmx1cicsIHRvZ2dsZUZvY3VzLCB0cnVlICk7XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogU2V0cyBvciByZW1vdmVzIC5mb2N1cyBjbGFzcyBvbiBhbiBlbGVtZW50LlxuICAgICAqL1xuICAgIGZ1bmN0aW9uIHRvZ2dsZUZvY3VzKCkge1xuICAgICAgdmFyIHNlbGYgPSB0aGlzO1xuXG4gICAgICAvLyBNb3ZlIHVwIHRocm91Z2ggdGhlIGFuY2VzdG9ycyBvZiB0aGUgY3VycmVudCBsaW5rIHVudGlsIHdlIGhpdCAubmF2LW1lbnUuXG4gICAgICB3aGlsZSAoIC0xID09PSBzZWxmLmNsYXNzTmFtZS5pbmRleE9mKCAnbmF2LW1lbnUnICkgKSB7XG5cbiAgICAgICAgLy8gT24gbGkgZWxlbWVudHMgdG9nZ2xlIHRoZSBjbGFzcyAuZm9jdXMuXG4gICAgICAgIGlmICggJ2xpJyA9PT0gc2VsZi50YWdOYW1lLnRvTG93ZXJDYXNlKCkgKSB7XG4gICAgICAgICAgaWYgKCAtMSAhPT0gc2VsZi5jbGFzc05hbWUuaW5kZXhPZiggJ2ZvY3VzJyApICkge1xuICAgICAgICAgICAgc2VsZi5jbGFzc05hbWUgPSBzZWxmLmNsYXNzTmFtZS5yZXBsYWNlKCAnIGZvY3VzJywgJycgKTtcbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgc2VsZi5jbGFzc05hbWUgKz0gJyBmb2N1cyc7XG4gICAgICAgICAgfVxuICAgICAgICB9XG5cbiAgICAgICAgc2VsZiA9IHNlbGYucGFyZW50RWxlbWVudDtcbiAgICAgIH1cbiAgICB9XG4gIH1cblxuICAvKipcbiAgICogVG9nZ2xlcyBgZm9jdXNgIGNsYXNzIHRvIGFsbG93IHN1Ym1lbnUgYWNjZXNzIG9uIHRhYmxldHMuXG4gICAqL1xuICAoIGZ1bmN0aW9uKCBjb2xsZWN0aW9uICkge1xuICAgIGZvciggbGV0IGNvbnRhaW5lciBvZiBjb2xsZWN0aW9uICkge1xuICAgICAgdmFyIHRvdWNoU3RhcnRGbiwgaSxcbiAgICAgICAgcGFyZW50TGluayA9IGNvbnRhaW5lci5xdWVyeVNlbGVjdG9yQWxsKCAnLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBhLCAucGFnZV9pdGVtX2hhc19jaGlsZHJlbiA+IGEnICk7XG5cbiAgICAgIGlmICggJ29udG91Y2hzdGFydCcgaW4gd2luZG93ICkge1xuICAgICAgICB0b3VjaFN0YXJ0Rm4gPSBmdW5jdGlvbiggZSApIHtcbiAgICAgICAgICB2YXIgbWVudUl0ZW0gPSB0aGlzLnBhcmVudE5vZGUsIGk7XG5cbiAgICAgICAgICBpZiAoICEgbWVudUl0ZW0uY2xhc3NMaXN0LmNvbnRhaW5zKCAnZm9jdXMnICkgKSB7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICBmb3IgKCBpID0gMDsgaSA8IG1lbnVJdGVtLnBhcmVudE5vZGUuY2hpbGRyZW4ubGVuZ3RoOyArK2kgKSB7XG4gICAgICAgICAgICAgIGlmICggbWVudUl0ZW0gPT09IG1lbnVJdGVtLnBhcmVudE5vZGUuY2hpbGRyZW5baV0gKSB7XG4gICAgICAgICAgICAgICAgY29udGludWU7XG4gICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgbWVudUl0ZW0ucGFyZW50Tm9kZS5jaGlsZHJlbltpXS5jbGFzc0xpc3QucmVtb3ZlKCAnZm9jdXMnICk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBtZW51SXRlbS5jbGFzc0xpc3QuYWRkKCAnZm9jdXMnICk7XG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIG1lbnVJdGVtLmNsYXNzTGlzdC5yZW1vdmUoICdmb2N1cycgKTtcbiAgICAgICAgICB9XG4gICAgICAgIH07XG5cbiAgICAgICAgZm9yICggaSA9IDA7IGkgPCBwYXJlbnRMaW5rLmxlbmd0aDsgKytpICkge1xuICAgICAgICAgIHBhcmVudExpbmtbaV0uYWRkRXZlbnRMaXN0ZW5lciggJ3RvdWNoc3RhcnQnLCB0b3VjaFN0YXJ0Rm4gKTtcbiAgICAgICAgfVxuICAgICAgfVxuICAgIH1cbiAgfSggY29sbGVjdGlvbiApICk7XG59ICkoKTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./js/navigation.js\n");

/***/ }),

/***/ "./js/skip-link-focus-fix.js":
/*!***********************************!*\
  !*** ./js/skip-link-focus-fix.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * File skip-link-focus-fix.js.\n *\n * Helps with accessibility for keyboard only users.\n *\n * Learn more: https://git.io/vWdr2\n */\n( function() {\n\tvar isIe = /(trident|msie)/i.test( navigator.userAgent );\n\n\tif ( isIe && document.getElementById && window.addEventListener ) {\n\t\twindow.addEventListener( 'hashchange', function() {\n\t\t\tvar id = location.hash.substring( 1 ),\n\t\t\t\telement;\n\n\t\t\tif ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {\n\t\t\t\treturn;\n\t\t\t}\n\n\t\t\telement = document.getElementById( id );\n\n\t\t\tif ( element ) {\n\t\t\t\tif ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {\n\t\t\t\t\telement.tabIndex = -1;\n\t\t\t\t}\n\n\t\t\t\telement.focus();\n\t\t\t}\n\t\t}, false );\n\t}\n} )();\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9za2lwLWxpbmstZm9jdXMtZml4LmpzP2ZlYjciXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0EsR0FBRztBQUNIO0FBQ0EsQ0FBQyIsImZpbGUiOiIuL2pzL3NraXAtbGluay1mb2N1cy1maXguanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIEZpbGUgc2tpcC1saW5rLWZvY3VzLWZpeC5qcy5cbiAqXG4gKiBIZWxwcyB3aXRoIGFjY2Vzc2liaWxpdHkgZm9yIGtleWJvYXJkIG9ubHkgdXNlcnMuXG4gKlxuICogTGVhcm4gbW9yZTogaHR0cHM6Ly9naXQuaW8vdldkcjJcbiAqL1xuKCBmdW5jdGlvbigpIHtcblx0dmFyIGlzSWUgPSAvKHRyaWRlbnR8bXNpZSkvaS50ZXN0KCBuYXZpZ2F0b3IudXNlckFnZW50ICk7XG5cblx0aWYgKCBpc0llICYmIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkICYmIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyICkge1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCAnaGFzaGNoYW5nZScsIGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIGlkID0gbG9jYXRpb24uaGFzaC5zdWJzdHJpbmcoIDEgKSxcblx0XHRcdFx0ZWxlbWVudDtcblxuXHRcdFx0aWYgKCAhICggL15bQS16MC05Xy1dKyQvLnRlc3QoIGlkICkgKSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRlbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIGlkICk7XG5cblx0XHRcdGlmICggZWxlbWVudCApIHtcblx0XHRcdFx0aWYgKCAhICggL14oPzphfHNlbGVjdHxpbnB1dHxidXR0b258dGV4dGFyZWEpJC9pLnRlc3QoIGVsZW1lbnQudGFnTmFtZSApICkgKSB7XG5cdFx0XHRcdFx0ZWxlbWVudC50YWJJbmRleCA9IC0xO1xuXHRcdFx0XHR9XG5cblx0XHRcdFx0ZWxlbWVudC5mb2N1cygpO1xuXHRcdFx0fVxuXHRcdH0sIGZhbHNlICk7XG5cdH1cbn0gKSgpO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./js/skip-link-focus-fix.js\n");

/***/ }),

/***/ "./sass/style.scss":
/*!*************************!*\
  !*** ./sass/style.scss ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zYXNzL3N0eWxlLnNjc3M/YTFjMCJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSIsImZpbGUiOiIuL3Nhc3Mvc3R5bGUuc2Nzcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./sass/style.scss\n");

/***/ })

/******/ });