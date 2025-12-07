<h1 class="mt-0 mb-4 lh-1">Редактировать аудиторию</h1>
<form class="form" action="<?= base_url('/admin/auditories/edit/' . $auditory['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="building_id">Здание</label>
        <select class="form__select <?= getValidationClass('building_id') ?>" name="building_id" id="building_id">
            <? if (empty($auditory['building_id'])): ?>
                <option value="" selected disabled>Выберите здание</option>
            <? endif; ?>
            <? foreach ($buildings as $building): ?>
                <option value="<?= $building['id'] ?>" <?= $building['id'] == $auditory['building_id'] ? 'selected' : '' ?>>
                    <?= $building['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('building_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input <?= getValidationClass('code') ?>" type="text" name="code" id="code" value="<?= $auditory['code'] ?>" placeholder="101">
        <?= getErrors('code') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Имя аудитории</label>
        <input class="form__input <?= getValidationClass('name') ?>" type="text" name="name" id="name" value="<?= $auditory['name'] ?>" placeholder="Аудитория 101">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="capacity">Вместимость</label>
        <input class="form__input <?= getValidationClass('capacity') ?>" type="number" name="capacity" id="capacity" value="<?= $auditory['capacity'] ?>" placeholder="80">
        <?= getErrors('capacity') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="room_type_id">Тип аудитории</label>
        <select class="form__select <?= getValidationClass('room_type_id') ?>" name="room_type_id" id="room_type_id">
            <? if (empty($auditory['room_type_id'])): ?>
                <option value="" selected disabled>Выберите тип аудитории</option>
            <? endif; ?>
            <? foreach ($roomTypes as $roomType): ?>
                <option value="<?= $roomType['id'] ?>" <?= $roomType['id'] == $auditory['room_type_id'] ? 'selected' : '' ?>>
                    <?= $roomType['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('room_type_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="floor">Этаж</label>
        <input class="form__input <?= getValidationClass('floor') ?>" type="number" name="floor" id="floor" value="<?= $auditory['floor'] ?>" placeholder="1">
        <?= getErrors('floor') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="notes">Примечание</label>
        <input class="form__input <?= getValidationClass('notes') ?>" type="text" name="notes" id="notes" value="<?= $auditory['notes'] ?>" placeholder="comment">
        <?= getErrors('notes') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Сохранить</button>
</form>