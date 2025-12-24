import { getCookie, setCookie } from './cookie.js';

$(function () {
	const STORAGE_KEY = 'openMenu';

	let list = getStorageListOpenMenu();

	function getStorageListOpenMenu() {
		const raw = getCookie(STORAGE_KEY);
		if (!raw) return [];
		return raw
			.split(',')
			.map((s) => s.trim())
			.filter(Boolean);
	}

	function setStorageListOpenMenu(arr) {
		setCookie(STORAGE_KEY, arr.join(','), { 'max-age': 10 * 365 * 24 * 60 * 60 });
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
