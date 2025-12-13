(self["webpackChunkproject_frontend"] = self["webpackChunkproject_frontend"] || []).push([["app"],{

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
/* harmony import */ var _main_dropdown_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./main/dropdown.js */ "./src/js/main/dropdown.js");






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

/***/ "./src/js/main/dropdown.js":
/*!*********************************!*\
  !*** ./src/js/main/dropdown.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cookie_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cookie.js */ "./src/js/main/cookie.js");


$(function () {
	const STORAGE_KEY = 'openMenu';

	let list = getStorageListOpenMenu();

	function getStorageListOpenMenu() {
		const raw = (0,_cookie_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)(STORAGE_KEY);
		if (!raw) return [];
		return raw
			.split(',')
			.map((s) => s.trim())
			.filter(Boolean);
	}

	function setStorageListOpenMenu(arr) {
		(0,_cookie_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)(STORAGE_KEY, arr.join(','), { secure: false, 'max-age': 10 * 365 * 24 * 60 * 60 });
	}

	/**
	 * Обновить список открытых в памяти.
	 * @param {string} item - название секции
	 * @param {boolean} add - true = добавить, false = удалить
	 */
	function updateOpenList(item, add) {
		if (!item) return;

		const idx = list.indexOf(item);
		if (add) {
			if (idx === -1) {
				list.push(item);
			}
		} else {
			if (idx !== -1) {
				list.splice(idx, 1);
			}
		}
		setStorageListOpenMenu(list);
	}

	function getSectionName($section) {
		const $nameSpan = $section.find('.menu__section-name').children('span').last();
		return $nameSpan.text().trim();
	}

	$('.menu__section').each(function () {
		const $section = $(this);
		const name = getSectionName($section);
		const $list = $section.find('.menu__list');

		if (list.includes(name)) {
			$list.removeClass('hide');
		} else {
			$list.addClass('hide');
		}
	});

	$(document).on('click', '.menu__header', function () {
		const $section = $(this).closest('.menu__section');
		const $list = $section.find('.menu__list');

		$list.toggleClass('hide');

		const isOpen = !$list.hasClass('hide');
		const name = getSectionName($section);

		updateOpenList(name, isOpen);
	});
});


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
		if (href === currentUri || currentUri.includes(href)) {
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

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors"], () => (__webpack_exec__("./src/js/import.js"), __webpack_exec__("./src/js/main/app.js"), __webpack_exec__("./src/scss/settings.scss")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=app.js.map