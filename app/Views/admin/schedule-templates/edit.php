<h1 class="mt-0 mb-4 lh-1">Редактировать занятие для группы</h1>

<form class="form" action="<?= base_url("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $itemId) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="subject_id">Предмет</label>
        <select class="form__select <?= getValidationClass('subject_id') ?>" name="subject_id" id="subject_id">
            <? $oldValue = $schedule['subject_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите предмет</option>
            <? endif; ?>
            <? foreach ($subjects as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('subject_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="teacher_id">Преподаватель</label>
        <select class="form__select <?= getValidationClass('teacher_id') ?>" name="teacher_id" id="teacher_id">
            <? $oldValue = $schedule['teacher_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите преподавателя</option>
            <? endif; ?>
            <? foreach ($teachers as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['name'] ?> (<?= $item["academic_degree"] ?>)
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('teacher_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="room_id">Аудитория</label>
        <select class="form__select <?= getValidationClass('room_id') ?>" name="room_id" id="room_id">
            <? $oldValue = $schedule['room_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите аудиторию</option>
            <? endif; ?>
            <? foreach ($auditories as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['name'] ?> (<?= $item["building_name"] ?>)
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('room_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="lesson_type_id">Тип занятия</label>
        <select class="form__select <?= getValidationClass('lesson_type_id') ?>" name="lesson_type_id" id="lesson_type_id">
            <? $oldValue = $schedule['lesson_type_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите тип занятия</option>
            <? endif; ?>
            <? foreach ($lessonTypes as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('lesson_type_id') ?>
    </div>
    <div class="d-grid grid-col-3 gap-2">
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="day_of_week">День недели</label>
            <select class="form__select <?= getValidationClass('day_of_week') ?>" name="day_of_week" id="day_of_week">
                <? $oldValue = $schedule['day_of_week']; ?>
                <? if (!$oldValue): ?>
                    <option value="" selected disabled>Выберите день недели</option>
                <? endif; ?>
                <? foreach ($days as $key => $item): ?>
                    <option value="<?= $key ?>" <?= $oldValue == $key ? 'selected' : '' ?>>
                        <?= $item ?>
                    </option>
                <? endforeach ?>
            </select>
            <?= getErrors('day_of_week') ?>
        </div>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="start_time">Начало занятия</label>
            <input class="form__time" type="time" name="start_time" id="start_time" value="<?= $schedule['start_time'] ?>">
            <?= getErrors('start_time') ?>
        </div>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="end_time">Конец занятия</label>
            <input class="form__time" type="time" name="end_time" id="end_time" value="<?= $schedule['end_time'] ?>">
            <?= getErrors('end_time') ?>
        </div>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="notes">Дополнительные примечания</label>
        <input class="form__input" type="text" name="notes" id="notes" value="<?= $schedule['notes'] ?>">
        <?= getErrors('notes') ?>
    </div>
    <div class="form__group d-flex align-items-left">
        <label class="form__label" for="is_active">Активность</label>
        <input class="form__checkbox <?= getValidationClass('is_active') ?>" type="checkbox" name="is_active" id="is_active" <?= $schedule['is_active'] ? 'checked' : '' ?>>
        <?= getErrors('is_active') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Изменить</button>
</form>