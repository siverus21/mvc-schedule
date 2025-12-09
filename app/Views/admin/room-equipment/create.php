<h1 class="mt-0 mb-4 lh-1">Создать тип оборудования</h1>

<form class="form" action="<?= base_url('/admin/room-equipment/create') ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="room_id">Аудитория</label>
        <select class="form__select <?= getValidationClass('room_id') ?>" name="room_id" id="room_id">
            <option value="" selected disabled>Выберите аудиторию</option>
            <? foreach ($rooms as $room): ?>
                <option value="<?= $room['id'] ?>">
                    <?= $room['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('room_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="equipment_type_id">Оборудование</label>
        <select class="form__select <?= getValidationClass('equipment_id') ?>" name="equipment_type_id" id="equipment_type_id">
            <option value="" selected disabled>Выберите оборудование</option>
            <? foreach ($equipmentTypes as $equipment): ?>
                <option value="<?= $equipment['id'] ?>">
                    <?= $equipment['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('equipment_type_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="quantity">Количество оборудования</label>
        <input class="form__input" type="number" name="quantity" id="quantity" value="<?= old('quantity') ?>">
        <?= getErrors('quantity') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="description">Описание</label>
        <input class="form__input" type="text" name="description" id="description" value="<?= old('description') ?>">
        <?= getErrors('description') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>