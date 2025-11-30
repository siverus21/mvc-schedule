$(function () {
	$(document).on('click', '.alert__cross', function () {
		$(this).parent().remove();
	});
});
