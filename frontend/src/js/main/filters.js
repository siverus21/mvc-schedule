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
export { FiltersAPI };
