<h1 class="mt-0 mb-4 lh-1">Редактирование типа оборудования</h1>

<form class="form" action="<?= base_url('/admin/equipment-types/edit/' . $equipmentType['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="" value="<?= $equipmentType['code'] ?>">
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название типа оборудования</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="" value="<?= $equipmentType['name'] ?>">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="description">Описание</label>
        <input class="form__input" type="text" name="description" id="description" placeholder="" value="<?= $equipmentType['description'] ?>">
        <?= getErrors('description') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>