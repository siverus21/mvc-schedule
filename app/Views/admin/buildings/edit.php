<h1 class="mt-0 mb-4 lh-1">Редактирование здания</h1>

<form class="form" action="<?= base_url('/admin/buildings/edit/' . $building['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="" value="<?= $building['code'] ?>">
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название здания</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="" value="<?= $building['name'] ?>">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="address">Адрес</label>
        <input class="form__input" type="text" name="address" id="address" placeholder="" value="<?= $building['address'] ?>">
        <?= getErrors('address') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Изменить</button>
</form>