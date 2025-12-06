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
