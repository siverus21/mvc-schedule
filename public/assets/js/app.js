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
/* harmony import */ var _main_alert_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./main/alert.js */ "./src/js/main/alert.js");
/* harmony import */ var _main_alert_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_main_alert_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _main_left_menu_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./main/left-menu.js */ "./src/js/main/left-menu.js");
/* harmony import */ var _main_left_menu_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_main_left_menu_js__WEBPACK_IMPORTED_MODULE_3__);





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

	iziModalAlertSuccess = $('.iziModal-alert-success');
	iziModalAlertError = $('.iziModal-alert-error');

	iziModalAlertSuccess.iziModal({
		padding: 20,
		title: 'Success',
		headerColor: '#00897b',
	});
	iziModalAlertError.iziModal({
		padding: 20,
		title: 'Error',
		headerColor: '#e53935',
	});
});


/***/ }),

/***/ "./src/js/main/change-theme.js":
/*!*************************************!*\
  !*** ./src/js/main/change-theme.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cookie_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cookie.js */ "./src/js/main/cookie.js");


$(function () {
	let $btn = $('.js-change-color-theme');
	const STORAGE_KEY = 'themePreference';
	let saved = (0,_cookie_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)(STORAGE_KEY);
	let systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
	let initialTheme = saved ? saved : systemPrefersDark ? 'dark-theme' : 'light-theme';

	setTheme(initialTheme);

	$btn.on('click', function () {
		var current =
			document.documentElement.getAttribute('data-theme') === 'dark-theme' ? 'dark-theme' : 'light-theme';
		var next = current === 'dark-theme' ? 'light-theme' : 'dark-theme';
		setTheme(next);
	});

	function setTheme(theme) {
		$(document.documentElement).attr('data-theme', theme === 'dark-theme' ? 'dark-theme' : 'light-theme');
		$('body').toggleClass('dark-theme', theme === 'dark-theme');
		let date = new Date();
		(0,_cookie_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)(STORAGE_KEY, theme, { secure: false, 'max-age': date.getTime() + 10 * 365 * 24 * 60 * 60 });
	}
});


/***/ }),

/***/ "./src/js/main/cookie.js":
/*!*******************************!*\
  !*** ./src/js/main/cookie.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   deleteCookie: () => (/* binding */ deleteCookie),
/* harmony export */   getCookie: () => (/* binding */ getCookie),
/* harmony export */   setCookie: () => (/* binding */ setCookie)
/* harmony export */ });
function getCookie(name) {
	let matches = document.cookie.match(
		new RegExp('(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)')
	);
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {
	options = {
		path: '/',
		// при необходимости добавьте другие значения по умолчанию
		...options,
	};

	if (options.expires instanceof Date) {
		options.expires = options.expires.toUTCString();
	}

	let updatedCookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);

	for (let optionKey in options) {
		updatedCookie += '; ' + optionKey;
		let optionValue = options[optionKey];
		if (optionValue !== true) {
			updatedCookie += '=' + optionValue;
		}
	}

	document.cookie = updatedCookie;
}

function deleteCookie(name) {
	setCookie(name, '', {
		'max-age': -1,
	});
}


/***/ }),

/***/ "./src/js/main/left-menu.js":
/*!**********************************!*\
  !*** ./src/js/main/left-menu.js ***!
  \**********************************/
/***/ (() => {

$(function () {
	let currentUri = location.origin + location.pathname.replace(/\/$/, '');
	$('.menu a').each(function () {
		let href = $(this).attr('href').replace(/\/$/, '');
		if (href === currentUri) {
			$(this).parent().addClass('menu__item_active');
		}
	});
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