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
