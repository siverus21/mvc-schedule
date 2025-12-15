<h1 class="mt-0 mb-4 lh-1">Редактировать преподавателя</h1>

<form class="form" action="<?= base_url('/admin/teachers/edit/' . $teacher['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="user_id">Пользователь</label>
        <select class="form__select <?= getValidationClass('user_id') ?>" name="user_id" id="user_id">
            <? $oldValue = $teacher['user_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите пользователя</option>
            <? endif; ?>
            <? foreach ($users as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['display_name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('user_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="department_id">Кафедра/отдел</label>
        <select class="form__select <?= getValidationClass('department_id') ?>" name="department_id" id="department_id">
            <? $oldValue = $teacher['department_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите кафедру</option>
            <? endif; ?>
            <? foreach ($department as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('department_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="academic_degree_id">Учёное звание/степень</label>
        <select class="form__select <?= getValidationClass('academic_degree_id') ?>" name="academic_degree_id" id="academic_degree_id">
            <? $oldValue = $teacher['academic_degree_id']; ?>
            <? if (!$oldValue): ?>
                <option value="" selected disabled>Выберите ученую степень пользователя</option>
            <? endif; ?>
            <? foreach ($academicDegree as $item): ?>
                <option value="<?= $item['id'] ?>" <?= $oldValue == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('academic_degree_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="staff_number">Табельный/штатный номер</label>
        <input class="form__input" type="text" name="staff_number" id="staff_number" placeholder="T-2025-045" value="<?= $teacher['staff_number'] ?>">
        <?= getErrors('staff_number') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Изменить</button>
</form>