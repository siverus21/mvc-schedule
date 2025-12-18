import { FiltersAPI } from '../main/filters.js';
import { getCookie, setCookie } from './cookie.js';

$(function () {
	let changeLastSchedule = getCookie('lastScheduleId');

	let sub = FiltersAPI.onFiltersChange(
		function (e, filters) {
			getSchedule(filters);
		},
		'.filter__form',
		200
	);

	if (changeLastSchedule) {
		FiltersAPI.setFilter('group', changeLastSchedule, '.filter__form');
		let filters = FiltersAPI.getFilters('.filter__form');
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
				setCookie('lastScheduleId', filters['group'], { secure: false, 'max-age': 24 * 60 * 60 });
			},
			error: function (err) {
				console.error('Error fetching schedule:', err);
			},
		});
	}
});
