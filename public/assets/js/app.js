/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/import.js":
/*!**************************!*\
  !*** ./src/js/import.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_app_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main/app.js */ "./src/js/main/app.js");
/* harmony import */ var _main_app_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_main_app_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _main_change_theme_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./main/change-theme.js */ "./src/js/main/change-theme.js");
/* harmony import */ var _main_change_theme_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_main_change_theme_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _main_alert_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./main/alert.js */ "./src/js/main/alert.js");
/* harmony import */ var _main_alert_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_main_alert_js__WEBPACK_IMPORTED_MODULE_2__);
// import js




/***/ }),

/***/ "./src/js/main/alert.js":
/*!******************************!*\
  !*** ./src/js/main/alert.js ***!
  \******************************/
/***/ (() => {

$(function () {
	$(document).on('click', '.alert__cross', function () {
		$(this).parent().remove();
	});
});


/***/ }),

/***/ "./src/js/main/app.js":
/*!****************************!*\
  !*** ./src/js/main/app.js ***!
  \****************************/
/***/ (() => {

$(function () {
	$('.js-schedule-select-week').on('click', function () {
		$(this).addClass('button_active');
		$('.js-schedule-select-day').removeClass('button_active');
	});

	$('.js-schedule-select-day').on('click', function () {
		$(this).addClass('button_active');
		$('.js-schedule-select-week').removeClass('button_active');
	});
});


/***/ }),

/***/ "./src/js/main/change-theme.js":
/*!*************************************!*\
  !*** ./src/js/main/change-theme.js ***!
  \*************************************/
/***/ (() => {

$(function () {
	var $btn = $('.js-change-color-theme');
	var STORAGE_KEY = 'themePreference';
	var saved = localStorage.getItem(STORAGE_KEY);
	var systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
	var initialTheme = saved ? saved : systemPrefersDark ? 'dark' : 'light';

	setTheme(initialTheme);

	$btn.on('click', function () {
		var current = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
		var next = current === 'dark' ? 'light' : 'dark';
		setTheme(next);
	});

	function setTheme(theme) {
		$(document.documentElement).attr('data-theme', theme === 'dark' ? 'dark' : 'light');
		$('body').toggleClass('dark-theme', theme === 'dark');
		localStorage.setItem(STORAGE_KEY, theme);
	}
});


/***/ }),

/***/ "./src/scss/settings.scss":
/*!********************************!*\
  !*** ./src/scss/settings.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_require__("./src/js/import.js");
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	__webpack_require__("./src/js/main/app.js");
/******/ 	var __webpack_exports__ = __webpack_require__("./src/scss/settings.scss");
/******/ 	
/******/ })()
;
//# sourceMappingURL=app.js.map