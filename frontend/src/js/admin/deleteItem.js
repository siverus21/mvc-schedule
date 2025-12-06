$(function () {
	$(document).on('click', '.js-delete-item', function (e) {
		e.preventDefault();

		let id = $(this).attr('data-id');
		let link = window.location.pathname + '/delete/' + id;
		let btn = $(this);
		let btnText = btn.text();

		$.ajax({
			url: link,
			method: 'POST',
			beforeSend: function () {
				btn.prop('disabled', true).text('Отправляю...');
			},
			success: function (res) {
				res = JSON.parse(res);
				if (res.status === 'success') {
					iziModalAlertSuccess.iziModal('setContent', {
						content: res.data,
					});
					iziModalAlertSuccess.iziModal('open');
					if (res.redirect) {
						$(document).on('closed', iziModalAlertSuccess, function (e) {
							location = res.redirect;
						});
					}
				} else {
					iziModalAlertError.iziModal('setContent', {
						content: res.data,
					});
					iziModalAlertError.iziModal('open');
					btn.prop('disabled', false).text(btnText);
				}
			},
			error: function () {
				iziModalAlertError.iziModal('setContent', {
					content: 'Произошла ошибка',
				});
				iziModalAlertError.iziModal('open');
				btn.prop('disabled', false).text(btnText);
			},
		});
	});
});
