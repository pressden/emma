!function(n){var e={};function t(l){if(e[l])return e[l].exports;var g=e[l]={i:l,l:!1,exports:{}};return n[l].call(g.exports,g,g.exports,t),g.l=!0,g.exports}t.m=n,t.c=e,t.d=function(n,e,l){t.o(n,e)||Object.defineProperty(n,e,{enumerable:!0,get:l})},t.r=function(n){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(n,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(n,"__esModule",{value:!0})},t.t=function(n,e){if(1&e&&(n=t(n)),8&e)return n;if(4&e&&"object"==typeof n&&n&&n.__esModule)return n;var l=Object.create(null);if(t.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:n}),2&e&&"string"!=typeof n)for(var g in n)t.d(l,g,function(e){return n[e]}.bind(null,g));return l},t.n=function(n){var e=n&&n.__esModule?function(){return n.default}:function(){return n};return t.d(e,"a",e),e},t.o=function(n,e){return Object.prototype.hasOwnProperty.call(n,e)},t.p="",t(t.s=0)}([function(module,__webpack_exports__,__webpack_require__){"use strict";eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _sass_style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);\n/* harmony import */ var _sass_style_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_sass_style_scss__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _navigation__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(2);\n/* harmony import */ var _navigation__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_navigation__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(3);\n/* harmony import */ var _skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_skip_link_focus_fix__WEBPACK_IMPORTED_MODULE_2__);\n\n\n\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9pbmRleC5qcz9lZTFjIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQTRCOztBQUVOO0FBQ1MiLCJmaWxlIjoiMC5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi4vc2Fzcy9zdHlsZS5zY3NzJztcblxuaW1wb3J0ICcuL25hdmlnYXRpb24nO1xuaW1wb3J0ICcuL3NraXAtbGluay1mb2N1cy1maXgnO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///0\n")},function(module,exports,__webpack_require__){eval("// extracted by mini-css-extract-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zYXNzL3N0eWxlLnNjc3M/MTZhYSJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSIsImZpbGUiOiIxLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///1\n")},function(module,exports){eval("/**\n * File navigation.js.\n *\n * Handles toggling the navigation menu for small screens and enables TAB key\n * navigation support for dropdown menus.\n */\n( function() {\n  var collection, container, drawer, clones, toggle, closer, menu, links, i, len;\n\n  toggle = document.getElementById( 'menu-toggle' );\n  closer = document.getElementById( 'menu-closer' );\n  drawer = document.getElementById( 'menu-drawer' );\n  clones = document.getElementById( 'menu-clones' );\n\n  // @TODO: Evaluate performance with querySelectorAll vs. getElementById or getElementsByClassName\n  collection = document.querySelectorAll( '#masthead .site-navigation, #masthead .widget_nav_menu, #main-navigation' );\n\n  // Exit early if collection is empty of the toggle button is undefined\n\tif ( collection.legth === 0 || 'undefined' === typeof toggle ) {\n\t\treturn;\n  }\n\n  for( let container of collection ) {\n    menu = container.getElementsByTagName( 'ul' )[0];\n\n    // @TODO: Move this outside the for loop since one toggle button controls multiple menus\n    /*\n    // Hide menu toggle button if menu is empty and return early.\n    if ( 'undefined' === typeof menu ) {\n      toggle.style.display = 'none';\n      return;\n    }\n    */\n\n    // continue if the menu is empty\n    if ( 'undefined' === typeof menu ) {\n      continue;\n    }\n\n    // put a clone of the menu in the menu clones container\n    let clone = menu.cloneNode( true );\n    clones.appendChild( clone );\n\n    menu.setAttribute( 'aria-expanded', 'false' );\n    if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {\n      menu.className += ' nav-menu';\n    }\n\n    toggle.onclick = function() {\n      if ( -1 !== drawer.className.indexOf( 'toggled' ) ) {\n        drawer.className = drawer.className.replace( ' toggled', '' );\n        toggle.setAttribute( 'aria-expanded', 'false' );\n        menu.setAttribute( 'aria-expanded', 'false' );\n      } else {\n        drawer.className += ' toggled';\n        toggle.setAttribute( 'aria-expanded', 'true' );\n        menu.setAttribute( 'aria-expanded', 'true' );\n      }\n    };\n\n    closer.onclick = function() {\n      drawer.className = drawer.className.replace( ' toggled', '' );\n      toggle.setAttribute( 'aria-expanded', 'false' );\n      menu.setAttribute( 'aria-expanded', 'false' );\n    };\n\n    // Get all the link elements within the menu.\n    links = menu.getElementsByTagName( 'a' );\n\n    // Each time a menu link is focused or blurred, toggle focus.\n    for ( i = 0, len = links.length; i < len; i++ ) {\n      links[i].addEventListener( 'focus', toggleFocus, true );\n      links[i].addEventListener( 'blur', toggleFocus, true );\n    }\n\n    /**\n     * Sets or removes .focus class on an element.\n     */\n    function toggleFocus() {\n      var self = this;\n\n      // Move up through the ancestors of the current link until we hit .nav-menu.\n      while ( -1 === self.className.indexOf( 'nav-menu' ) ) {\n\n        // On li elements toggle the class .focus.\n        if ( 'li' === self.tagName.toLowerCase() ) {\n          if ( -1 !== self.className.indexOf( 'focus' ) ) {\n            self.className = self.className.replace( ' focus', '' );\n          } else {\n            self.className += ' focus';\n          }\n        }\n\n        self = self.parentElement;\n      }\n    }\n  }\n\n  /**\n   * Toggles `focus` class to allow submenu access on tablets.\n   */\n  ( function( collection ) {\n    for( let container of collection ) {\n      var touchStartFn, i,\n        parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );\n\n      if ( 'ontouchstart' in window ) {\n        touchStartFn = function( e ) {\n          var menuItem = this.parentNode, i;\n\n          if ( ! menuItem.classList.contains( 'focus' ) ) {\n            e.preventDefault();\n            for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {\n              if ( menuItem === menuItem.parentNode.children[i] ) {\n                continue;\n              }\n              menuItem.parentNode.children[i].classList.remove( 'focus' );\n            }\n            menuItem.classList.add( 'focus' );\n          } else {\n            menuItem.classList.remove( 'focus' );\n          }\n        };\n\n        for ( i = 0; i < parentLink.length; ++i ) {\n          parentLink[i].addEventListener( 'touchstart', touchStartFn );\n        }\n      }\n    }\n  }( collection ) );\n} )();\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9uYXZpZ2F0aW9uLmpzPzk1ODUiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLE9BQU87QUFDUDtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBLG9DQUFvQyxTQUFTO0FBQzdDO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQSxXQUFXO0FBQ1g7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0Esd0JBQXdCLHlDQUF5QztBQUNqRTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxXQUFXO0FBQ1g7QUFDQTtBQUNBOztBQUVBLG9CQUFvQix1QkFBdUI7QUFDM0M7QUFDQTtBQUNBO0FBQ0E7QUFDQSxHQUFHO0FBQ0gsQ0FBQyIsImZpbGUiOiIyLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBGaWxlIG5hdmlnYXRpb24uanMuXG4gKlxuICogSGFuZGxlcyB0b2dnbGluZyB0aGUgbmF2aWdhdGlvbiBtZW51IGZvciBzbWFsbCBzY3JlZW5zIGFuZCBlbmFibGVzIFRBQiBrZXlcbiAqIG5hdmlnYXRpb24gc3VwcG9ydCBmb3IgZHJvcGRvd24gbWVudXMuXG4gKi9cbiggZnVuY3Rpb24oKSB7XG4gIHZhciBjb2xsZWN0aW9uLCBjb250YWluZXIsIGRyYXdlciwgY2xvbmVzLCB0b2dnbGUsIGNsb3NlciwgbWVudSwgbGlua3MsIGksIGxlbjtcblxuICB0b2dnbGUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCggJ21lbnUtdG9nZ2xlJyApO1xuICBjbG9zZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCggJ21lbnUtY2xvc2VyJyApO1xuICBkcmF3ZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCggJ21lbnUtZHJhd2VyJyApO1xuICBjbG9uZXMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCggJ21lbnUtY2xvbmVzJyApO1xuXG4gIC8vIEBUT0RPOiBFdmFsdWF0ZSBwZXJmb3JtYW5jZSB3aXRoIHF1ZXJ5U2VsZWN0b3JBbGwgdnMuIGdldEVsZW1lbnRCeUlkIG9yIGdldEVsZW1lbnRzQnlDbGFzc05hbWVcbiAgY29sbGVjdGlvbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoICcjbWFzdGhlYWQgLnNpdGUtbmF2aWdhdGlvbiwgI21hc3RoZWFkIC53aWRnZXRfbmF2X21lbnUsICNtYWluLW5hdmlnYXRpb24nICk7XG5cbiAgLy8gRXhpdCBlYXJseSBpZiBjb2xsZWN0aW9uIGlzIGVtcHR5IG9mIHRoZSB0b2dnbGUgYnV0dG9uIGlzIHVuZGVmaW5lZFxuXHRpZiAoIGNvbGxlY3Rpb24ubGVndGggPT09IDAgfHwgJ3VuZGVmaW5lZCcgPT09IHR5cGVvZiB0b2dnbGUgKSB7XG5cdFx0cmV0dXJuO1xuICB9XG5cbiAgZm9yKCBsZXQgY29udGFpbmVyIG9mIGNvbGxlY3Rpb24gKSB7XG4gICAgbWVudSA9IGNvbnRhaW5lci5nZXRFbGVtZW50c0J5VGFnTmFtZSggJ3VsJyApWzBdO1xuXG4gICAgLy8gQFRPRE86IE1vdmUgdGhpcyBvdXRzaWRlIHRoZSBmb3IgbG9vcCBzaW5jZSBvbmUgdG9nZ2xlIGJ1dHRvbiBjb250cm9scyBtdWx0aXBsZSBtZW51c1xuICAgIC8qXG4gICAgLy8gSGlkZSBtZW51IHRvZ2dsZSBidXR0b24gaWYgbWVudSBpcyBlbXB0eSBhbmQgcmV0dXJuIGVhcmx5LlxuICAgIGlmICggJ3VuZGVmaW5lZCcgPT09IHR5cGVvZiBtZW51ICkge1xuICAgICAgdG9nZ2xlLnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG4gICAgICByZXR1cm47XG4gICAgfVxuICAgICovXG5cbiAgICAvLyBjb250aW51ZSBpZiB0aGUgbWVudSBpcyBlbXB0eVxuICAgIGlmICggJ3VuZGVmaW5lZCcgPT09IHR5cGVvZiBtZW51ICkge1xuICAgICAgY29udGludWU7XG4gICAgfVxuXG4gICAgLy8gcHV0IGEgY2xvbmUgb2YgdGhlIG1lbnUgaW4gdGhlIG1lbnUgY2xvbmVzIGNvbnRhaW5lclxuICAgIGxldCBjbG9uZSA9IG1lbnUuY2xvbmVOb2RlKCB0cnVlICk7XG4gICAgY2xvbmVzLmFwcGVuZENoaWxkKCBjbG9uZSApO1xuXG4gICAgbWVudS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuICAgIGlmICggLTEgPT09IG1lbnUuY2xhc3NOYW1lLmluZGV4T2YoICduYXYtbWVudScgKSApIHtcbiAgICAgIG1lbnUuY2xhc3NOYW1lICs9ICcgbmF2LW1lbnUnO1xuICAgIH1cblxuICAgIHRvZ2dsZS5vbmNsaWNrID0gZnVuY3Rpb24oKSB7XG4gICAgICBpZiAoIC0xICE9PSBkcmF3ZXIuY2xhc3NOYW1lLmluZGV4T2YoICd0b2dnbGVkJyApICkge1xuICAgICAgICBkcmF3ZXIuY2xhc3NOYW1lID0gZHJhd2VyLmNsYXNzTmFtZS5yZXBsYWNlKCAnIHRvZ2dsZWQnLCAnJyApO1xuICAgICAgICB0b2dnbGUuc2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcsICdmYWxzZScgKTtcbiAgICAgICAgbWVudS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgZHJhd2VyLmNsYXNzTmFtZSArPSAnIHRvZ2dsZWQnO1xuICAgICAgICB0b2dnbGUuc2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcsICd0cnVlJyApO1xuICAgICAgICBtZW51LnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAndHJ1ZScgKTtcbiAgICAgIH1cbiAgICB9O1xuXG4gICAgY2xvc2VyLm9uY2xpY2sgPSBmdW5jdGlvbigpIHtcbiAgICAgIGRyYXdlci5jbGFzc05hbWUgPSBkcmF3ZXIuY2xhc3NOYW1lLnJlcGxhY2UoICcgdG9nZ2xlZCcsICcnICk7XG4gICAgICB0b2dnbGUuc2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcsICdmYWxzZScgKTtcbiAgICAgIG1lbnUuc2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcsICdmYWxzZScgKTtcbiAgICB9O1xuXG4gICAgLy8gR2V0IGFsbCB0aGUgbGluayBlbGVtZW50cyB3aXRoaW4gdGhlIG1lbnUuXG4gICAgbGlua3MgPSBtZW51LmdldEVsZW1lbnRzQnlUYWdOYW1lKCAnYScgKTtcblxuICAgIC8vIEVhY2ggdGltZSBhIG1lbnUgbGluayBpcyBmb2N1c2VkIG9yIGJsdXJyZWQsIHRvZ2dsZSBmb2N1cy5cbiAgICBmb3IgKCBpID0gMCwgbGVuID0gbGlua3MubGVuZ3RoOyBpIDwgbGVuOyBpKysgKSB7XG4gICAgICBsaW5rc1tpXS5hZGRFdmVudExpc3RlbmVyKCAnZm9jdXMnLCB0b2dnbGVGb2N1cywgdHJ1ZSApO1xuICAgICAgbGlua3NbaV0uYWRkRXZlbnRMaXN0ZW5lciggJ2JsdXInLCB0b2dnbGVGb2N1cywgdHJ1ZSApO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIFNldHMgb3IgcmVtb3ZlcyAuZm9jdXMgY2xhc3Mgb24gYW4gZWxlbWVudC5cbiAgICAgKi9cbiAgICBmdW5jdGlvbiB0b2dnbGVGb2N1cygpIHtcbiAgICAgIHZhciBzZWxmID0gdGhpcztcblxuICAgICAgLy8gTW92ZSB1cCB0aHJvdWdoIHRoZSBhbmNlc3RvcnMgb2YgdGhlIGN1cnJlbnQgbGluayB1bnRpbCB3ZSBoaXQgLm5hdi1tZW51LlxuICAgICAgd2hpbGUgKCAtMSA9PT0gc2VsZi5jbGFzc05hbWUuaW5kZXhPZiggJ25hdi1tZW51JyApICkge1xuXG4gICAgICAgIC8vIE9uIGxpIGVsZW1lbnRzIHRvZ2dsZSB0aGUgY2xhc3MgLmZvY3VzLlxuICAgICAgICBpZiAoICdsaScgPT09IHNlbGYudGFnTmFtZS50b0xvd2VyQ2FzZSgpICkge1xuICAgICAgICAgIGlmICggLTEgIT09IHNlbGYuY2xhc3NOYW1lLmluZGV4T2YoICdmb2N1cycgKSApIHtcbiAgICAgICAgICAgIHNlbGYuY2xhc3NOYW1lID0gc2VsZi5jbGFzc05hbWUucmVwbGFjZSggJyBmb2N1cycsICcnICk7XG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHNlbGYuY2xhc3NOYW1lICs9ICcgZm9jdXMnO1xuICAgICAgICAgIH1cbiAgICAgICAgfVxuXG4gICAgICAgIHNlbGYgPSBzZWxmLnBhcmVudEVsZW1lbnQ7XG4gICAgICB9XG4gICAgfVxuICB9XG5cbiAgLyoqXG4gICAqIFRvZ2dsZXMgYGZvY3VzYCBjbGFzcyB0byBhbGxvdyBzdWJtZW51IGFjY2VzcyBvbiB0YWJsZXRzLlxuICAgKi9cbiAgKCBmdW5jdGlvbiggY29sbGVjdGlvbiApIHtcbiAgICBmb3IoIGxldCBjb250YWluZXIgb2YgY29sbGVjdGlvbiApIHtcbiAgICAgIHZhciB0b3VjaFN0YXJ0Rm4sIGksXG4gICAgICAgIHBhcmVudExpbmsgPSBjb250YWluZXIucXVlcnlTZWxlY3RvckFsbCggJy5tZW51LWl0ZW0taGFzLWNoaWxkcmVuID4gYSwgLnBhZ2VfaXRlbV9oYXNfY2hpbGRyZW4gPiBhJyApO1xuXG4gICAgICBpZiAoICdvbnRvdWNoc3RhcnQnIGluIHdpbmRvdyApIHtcbiAgICAgICAgdG91Y2hTdGFydEZuID0gZnVuY3Rpb24oIGUgKSB7XG4gICAgICAgICAgdmFyIG1lbnVJdGVtID0gdGhpcy5wYXJlbnROb2RlLCBpO1xuXG4gICAgICAgICAgaWYgKCAhIG1lbnVJdGVtLmNsYXNzTGlzdC5jb250YWlucyggJ2ZvY3VzJyApICkge1xuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgZm9yICggaSA9IDA7IGkgPCBtZW51SXRlbS5wYXJlbnROb2RlLmNoaWxkcmVuLmxlbmd0aDsgKytpICkge1xuICAgICAgICAgICAgICBpZiAoIG1lbnVJdGVtID09PSBtZW51SXRlbS5wYXJlbnROb2RlLmNoaWxkcmVuW2ldICkge1xuICAgICAgICAgICAgICAgIGNvbnRpbnVlO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgIG1lbnVJdGVtLnBhcmVudE5vZGUuY2hpbGRyZW5baV0uY2xhc3NMaXN0LnJlbW92ZSggJ2ZvY3VzJyApO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgbWVudUl0ZW0uY2xhc3NMaXN0LmFkZCggJ2ZvY3VzJyApO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBtZW51SXRlbS5jbGFzc0xpc3QucmVtb3ZlKCAnZm9jdXMnICk7XG4gICAgICAgICAgfVxuICAgICAgICB9O1xuXG4gICAgICAgIGZvciAoIGkgPSAwOyBpIDwgcGFyZW50TGluay5sZW5ndGg7ICsraSApIHtcbiAgICAgICAgICBwYXJlbnRMaW5rW2ldLmFkZEV2ZW50TGlzdGVuZXIoICd0b3VjaHN0YXJ0JywgdG91Y2hTdGFydEZuICk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9XG4gIH0oIGNvbGxlY3Rpb24gKSApO1xufSApKCk7XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///2\n")},function(module,exports){eval("/**\n * File skip-link-focus-fix.js.\n *\n * Helps with accessibility for keyboard only users.\n *\n * Learn more: https://git.io/vWdr2\n */\n( function() {\n\tvar isIe = /(trident|msie)/i.test( navigator.userAgent );\n\n\tif ( isIe && document.getElementById && window.addEventListener ) {\n\t\twindow.addEventListener( 'hashchange', function() {\n\t\t\tvar id = location.hash.substring( 1 ),\n\t\t\t\telement;\n\n\t\t\tif ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {\n\t\t\t\treturn;\n\t\t\t}\n\n\t\t\telement = document.getElementById( id );\n\n\t\t\tif ( element ) {\n\t\t\t\tif ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {\n\t\t\t\t\telement.tabIndex = -1;\n\t\t\t\t}\n\n\t\t\t\telement.focus();\n\t\t\t}\n\t\t}, false );\n\t}\n} )();\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9za2lwLWxpbmstZm9jdXMtZml4LmpzP2ZlYjciXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0EsR0FBRztBQUNIO0FBQ0EsQ0FBQyIsImZpbGUiOiIzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBGaWxlIHNraXAtbGluay1mb2N1cy1maXguanMuXG4gKlxuICogSGVscHMgd2l0aCBhY2Nlc3NpYmlsaXR5IGZvciBrZXlib2FyZCBvbmx5IHVzZXJzLlxuICpcbiAqIExlYXJuIG1vcmU6IGh0dHBzOi8vZ2l0LmlvL3ZXZHIyXG4gKi9cbiggZnVuY3Rpb24oKSB7XG5cdHZhciBpc0llID0gLyh0cmlkZW50fG1zaWUpL2kudGVzdCggbmF2aWdhdG9yLnVzZXJBZ2VudCApO1xuXG5cdGlmICggaXNJZSAmJiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCAmJiB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lciApIHtcblx0XHR3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lciggJ2hhc2hjaGFuZ2UnLCBmdW5jdGlvbigpIHtcblx0XHRcdHZhciBpZCA9IGxvY2F0aW9uLmhhc2guc3Vic3RyaW5nKCAxICksXG5cdFx0XHRcdGVsZW1lbnQ7XG5cblx0XHRcdGlmICggISAoIC9eW0EtejAtOV8tXSskLy50ZXN0KCBpZCApICkgKSB7XG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuXHRcdFx0ZWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCBpZCApO1xuXG5cdFx0XHRpZiAoIGVsZW1lbnQgKSB7XG5cdFx0XHRcdGlmICggISAoIC9eKD86YXxzZWxlY3R8aW5wdXR8YnV0dG9ufHRleHRhcmVhKSQvaS50ZXN0KCBlbGVtZW50LnRhZ05hbWUgKSApICkge1xuXHRcdFx0XHRcdGVsZW1lbnQudGFiSW5kZXggPSAtMTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdGVsZW1lbnQuZm9jdXMoKTtcblx0XHRcdH1cblx0XHR9LCBmYWxzZSApO1xuXHR9XG59ICkoKTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///3\n")}]);