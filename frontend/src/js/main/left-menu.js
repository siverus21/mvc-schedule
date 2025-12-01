$(function () {
	let currentUri = location.origin + location.pathname.replace(/\/$/, '');
	$('.menu a').each(function () {
		let href = $(this).attr('href').replace(/\/$/, '');
		if (href === currentUri) {
			$(this).parent().addClass('menu__item_active');
		}
	});
});
