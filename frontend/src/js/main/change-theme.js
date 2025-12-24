import { getCookie, setCookie } from './cookie.js';

$(function () {
	let $btn = $('.js-change-color-theme');
	const STORAGE_KEY = 'themePreference';
	let saved = getCookie(STORAGE_KEY);
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
		setCookie(STORAGE_KEY, theme, { 'max-age': date.getTime() + 10 * 365 * 24 * 60 * 60 });
	}
});
