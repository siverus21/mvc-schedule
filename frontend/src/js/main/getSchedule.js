import { FiltersAPI } from '../main/filters.js';
import { getCookie, setCookie } from './cookie.js';

$(function () {
	var changeLastSchedule = getCookie('lastScheduleId');
	var changeLastTeacher = getCookie('lastTeacherId');

	FiltersAPI.onFiltersChange(
		function (e, filters) {
			getSchedule(filters);
		},
		'.filter__form',
		200
	);

	// Восстанавливаем группу и/или преподавателя из куки
	if (changeLastSchedule) {
		FiltersAPI.setFilter('group', changeLastSchedule, '.filter__form');
	}
	if (changeLastTeacher) {
		FiltersAPI.setFilter('teacher', changeLastTeacher, '.filter__form');
	}
	if (changeLastSchedule || changeLastTeacher) {
		var filters = FiltersAPI.getFilters('.filter__form');
		getSchedule(filters);
	}

	function getSchedule(filters) {
		var group = filters['group'] != null ? String(filters['group']).trim() : '';
		var teacher = filters['teacher'] != null ? String(filters['teacher']).trim() : '';

		// Ни группа, ни преподаватель не выбраны — плейсхолдер и сброс куки
		if (!group && !teacher) {
			showSchedulePlaceholder('Выберите группу или преподавателя');
			setCookie('lastScheduleId', '', { 'max-age': 0 });
			setCookie('lastTeacherId', '', { 'max-age': 0 });
			return;
		}

		let csrfToken = $('meta[name="_csrf_token"]').attr('content');
		let payload = {
			group: group || '',
			teacher: teacher || '',
			_csrf_token: csrfToken,
		};

		var query = 'group=' + encodeURIComponent(payload.group) + '&teacher=' + encodeURIComponent(payload.teacher);
		$.ajax({
			url: '/api/v1/schedule?' + query,
			method: 'POST',
			data: payload,
			success: function (data) {
				if (!data.message) {
					return;
				}
				var $container = $('.schedule').first();
				if ($container.length) {
					$container.replaceWith(data.message);
				} else {
					$('.schedule__content').closest('.schedule').replaceWith(data.message);
				}
				console.log('[getSchedule] group=%s, teacher=%s', payload.group || '(все)', payload.teacher || '(все)');
				if (payload.group) {
					setCookie('lastScheduleId', payload.group, { 'max-age': 24 * 60 * 60 });
				} else {
					setCookie('lastScheduleId', '', { 'max-age': 0 });
				}
				if (payload.teacher) {
					setCookie('lastTeacherId', payload.teacher, { 'max-age': 24 * 60 * 60 });
				} else {
					setCookie('lastTeacherId', '', { 'max-age': 0 });
				}
			},
			error: function (err) {
				console.error('Error fetching schedule:', err);
			},
		});
	}

	function showSchedulePlaceholder(message) {
		message = message || 'Выберите группу или преподавателя';
		var html = '<div class="schedule">' +
			'<div class="d-flex justify-center"><p>' + message + '</p></div>' +
			'</div>';
		var $container = $('.schedule').first();
		if ($container.length) {
			$container.replaceWith(html);
		} else {
			$('main').find('.schedule__content').closest('.schedule').replaceWith(html);
		}
	}

	/**
	 * Фильтр по преподавателю: скрывает блоки занятий, у которых data-teacher-id не совпадает с выбранным.
	 * Если teacherId пустой — показываем все блоки. Обновляет счётчик пар в каждом дне.
	 */
	function applyTeacherFilter(teacherId) {
		let hasFilter = teacherId != null && String(teacherId).trim() !== '';

		$('.schedule__block').each(function () {
			let $block = $(this);
			let blockTeacherId = $block.attr('data-teacher-id') || '';
			let match = !hasFilter || blockTeacherId === String(teacherId);
			$block.toggle(match);
		});

		$('.schedule__day').each(function () {
			let count = $(this).find('.schedule__block:visible').length;
			$(this).find('.js-pairs-count').text(count);
		});
	}
});
