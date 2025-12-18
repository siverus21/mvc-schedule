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
/* harmony import */ var _main_getSchedule_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./main/getSchedule.js */ "./src/js/main/getSchedule.js");







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

/***/ "./src/js/main/filters.js":
/*!********************************!*\
  !*** ./src/js/main/filters.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   FiltersAPI: () => (/* binding */ FiltersAPI)
/* harmony export */ });
// filters.js — ES module
// Экспортирует: export { FiltersAPI }
const $ = window.jQuery;
if (!$) {
	throw new Error(
		'jQuery не найден. Подключите jQuery перед импортом FiltersAPI (например <script src="...jquery..."></script>).'
	);
}

const FiltersAPI = (function ($) {
	'use strict';

	function $form(form) {
		return form ? $(form).first() : $('.filter__form').first();
	}

	function getNamedElements($f) {
		return $f.find('[name]').filter(function () {
			return !$(this).prop('disabled');
		});
	}

	function getFilters(form) {
		var $f = $form(form);
		var result = {};
		getNamedElements($f).each(function () {
			var $el = $(this);
			var name = $el.attr('name');
			if (result.hasOwnProperty(name)) return;

			var elements = $f.find('[name="' + name + '"]');
			if (elements.length > 1) {
				var type = (elements.first().attr('type') || '').toLowerCase();
				if (type === 'checkbox') {
					var vals = [];
					elements.filter(':checked').each(function () {
						vals.push($(this).val());
					});
					result[name] = vals;
				} else if (type === 'radio') {
					var $sel = elements.filter(':checked').first();
					result[name] = $sel.length ? $sel.val() : null;
				} else {
					var arr = [];
					elements.each(function () {
						arr.push($(this).val());
					});
					result[name] = arr;
				}
			} else {
				var $single = elements.first();
				var tag = $single.prop('tagName').toLowerCase();
				var t = ($single.attr('type') || '').toLowerCase();

				if (tag === 'select' && $single.prop('multiple')) {
					var sel = [];
					$single.find('option:selected').each(function () {
						sel.push($(this).val());
					});
					result[name] = sel;
				} else if (t === 'checkbox') {
					result[name] = $single.prop('checked') ? $single.val() : null;
				} else if (t === 'radio') {
					var $checked = $single
						.closest('form,body')
						.find('[name="' + name + '"]:checked')
						.first();
					result[name] = $checked.length ? $checked.val() : null;
				} else {
					result[name] = $single.val();
				}
			}
		});
		return result;
	}

	function getFilter(name, form) {
		if (!name) return null;
		var $f = $form(form);
		var elements = $f.find('[name="' + name + '"]');
		if (!elements.length) return null;

		if (elements.length > 1) {
			var type = (elements.first().attr('type') || '').toLowerCase();
			if (type === 'checkbox') {
				var vals = [];
				elements.filter(':checked').each(function () {
					vals.push($(this).val());
				});
				return vals;
			}
			if (type === 'radio') {
				var $sel = elements.filter(':checked').first();
				return $sel.length ? $sel.val() : null;
			}
			var arr = [];
			elements.each(function () {
				arr.push($(this).val());
			});
			return arr;
		} else {
			var $el = elements.first();
			var tag = $el.prop('tagName').toLowerCase();
			var t = ($el.attr('type') || '').toLowerCase();
			if (tag === 'select' && $el.prop('multiple')) {
				var sel = [];
				$el.find('option:selected').each(function () {
					sel.push($(this).val());
				});
				return sel;
			}
			if (t === 'checkbox') return $el.prop('checked') ? $el.val() : null;
			if (t === 'radio') {
				var $ch = $f.find('[name="' + name + '"]:checked').first();
				return $ch.length ? $ch.val() : null;
			}
			return $el.val();
		}
	}

	function setFilter(name, value, form) {
		if (!name) return;
		var $f = $form(form);
		var elements = $f.find('[name="' + name + '"]');
		if (!elements.length) return;

		if (elements.length > 1) {
			var type = (elements.first().attr('type') || '').toLowerCase();
			if (type === 'checkbox') {
				if (value === true || value === false) {
					elements.prop('checked', !!value);
					return;
				}
				var arr = Array.isArray(value) ? value.map(String) : [String(value)];
				elements.each(function () {
					$(this).prop('checked', arr.indexOf(String($(this).val())) !== -1);
				});
				return;
			}
			if (type === 'radio') {
				elements.prop('checked', false);
				elements.filter('[value="' + String(value) + '"]').prop('checked', true);
				return;
			}
			if (Array.isArray(value)) {
				elements.each(function (i) {
					$(this).val(value[i] !== undefined ? value[i] : '');
				});
			} else {
				elements.first().val(value);
			}
			return;
		} else {
			var $el = elements.first();
			var tag = $el.prop('tagName').toLowerCase();
			var t = ($el.attr('type') || '').toLowerCase();
			if (tag === 'select' && $el.prop('multiple')) {
				var arr = Array.isArray(value) ? value.map(String) : value == null ? [] : [String(value)];
				$el.find('option').each(function () {
					$(this).prop('selected', arr.indexOf(String($(this).val())) !== -1);
				});
				return;
			}
			if (t === 'checkbox') {
				if (value === true || value === false) {
					$el.prop('checked', !!value);
				} else {
					$el.prop('checked', String($el.val()) === String(value));
				}
				return;
			}
			if (t === 'radio') {
				$f.find('[name="' + name + '"]').prop('checked', false);
				$f.find('[name="' + name + '"][value="' + String(value) + '"]').prop('checked', true);
				return;
			}
			$el.val(value);
		}
	}

	function clearFilter(name, form) {
		if (!name) return;
		var $f = $form(form);
		var elements = $f.find('[name="' + name + '"]');
		if (!elements.length) return;
		elements.each(function () {
			var $el = $(this);
			var tag = $el.prop('tagName').toLowerCase();
			var t = ($el.attr('type') || '').toLowerCase();
			if (t === 'checkbox' || t === 'radio') {
				$el.prop('checked', false);
			} else if (tag === 'select') {
				$el.prop('selectedIndex', -1);
			} else {
				$el.val('');
			}
		});
	}

	function clearAll(form) {
		var $f = $form(form);
		if ($f.length && $f[0].tagName && $f[0].tagName.toLowerCase() === 'form') {
			$f[0].reset();
			$f.find('select').each(function () {
				if ($(this).prop('multiple')) $(this).prop('selectedIndex', -1);
			});
		} else {
			getNamedElements($f).each(function () {
				clearFilter($(this).attr('name'), $f);
			});
		}
	}

	function hasFilter(name, form) {
		var $f = $form(form);
		return $f.find('[name="' + name + '"]').length > 0;
	}

	function isAnyFilterActive(form) {
		var f = getFilters(form);
		return Object.keys(f).some(function (k) {
			var v = f[k];
			if (v == null) return false;
			if (Array.isArray(v))
				return (
					v.length > 0 &&
					v.some(function (x) {
						return x !== null && x !== '';
					})
				);
			if (typeof v === 'string') return v !== '';
			return true;
		});
	}

	function onFiltersChange(handler, form, debounceMs) {
		var $f = $form(form);
		debounceMs = typeof debounceMs === 'number' ? debounceMs : 0;
		var timer = null;
		var proxy = function (e) {
			if (debounceMs > 0) {
				clearTimeout(timer);
				timer = setTimeout(function () {
					handler(e, getFilters($f));
				}, debounceMs);
			} else {
				handler(e, getFilters($f));
			}
		};
		$f.on('change.filtersApi input.filtersApi', '[name]', proxy);
		return function () {
			$f.off('.filtersApi');
		};
	}

	function serialize(form) {
		var f = getFilters(form);
		var clean = {};
		Object.keys(f).forEach(function (k) {
			var v = f[k];
			if (v == null) return;
			if (Array.isArray(v) && v.length === 0) return;
			clean[k] = v;
		});
		return $.param(clean, true);
	}

	return {
		getFilters: getFilters,
		getFilter: getFilter,
		setFilter: setFilter,
		clearFilter: clearFilter,
		clearAll: clearAll,
		hasFilter: hasFilter,
		isAnyFilterActive: isAnyFilterActive,
		onFiltersChange: onFiltersChange,
		serialize: serialize,
	};
})(window.jQuery);

// Named export



/***/ }),

/***/ "./src/js/main/getSchedule.js":
/*!************************************!*\
  !*** ./src/js/main/getSchedule.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_filters_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/filters.js */ "./src/js/main/filters.js");
/* harmony import */ var _cookie_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./cookie.js */ "./src/js/main/cookie.js");



$(function () {
	let changeLastSchedule = (0,_cookie_js__WEBPACK_IMPORTED_MODULE_1__.getCookie)('lastScheduleId');

	let sub = _main_filters_js__WEBPACK_IMPORTED_MODULE_0__.FiltersAPI.onFiltersChange(
		function (e, filters) {
			getSchedule(filters);
		},
		'.filter__form',
		200
	);

	if (changeLastSchedule) {
		_main_filters_js__WEBPACK_IMPORTED_MODULE_0__.FiltersAPI.setFilter('group', changeLastSchedule, '.filter__form');
		let filters = _main_filters_js__WEBPACK_IMPORTED_MODULE_0__.FiltersAPI.getFilters('.filter__form');
		getSchedule(filters);
	}

	function getSchedule(filters) {
		let csrfToken = $('meta[name="_csrf_token"]').attr('content');
		filters['_csrf_token'] = csrfToken;

		$.ajax({
			url: '/api/v1/schedule',
			method: 'POST',
			data: filters,
			success: function (data) {
				$('.schedule').html(data.message);
				(0,_cookie_js__WEBPACK_IMPORTED_MODULE_1__.setCookie)('lastScheduleId', filters['group'], { secure: false, 'max-age': 24 * 60 * 60 });
			},
			error: function (err) {
				console.error('Error fetching schedule:', err);
			},
		});
	}
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