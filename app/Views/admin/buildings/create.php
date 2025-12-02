<h1 class="mt-0 mb-4 lh-1">Создать здание</h1>

<form class="form" action="<?= base_url('/admin/buildings/create') ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="" value="<?= old('code') ?>">
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название здания</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="" value="<?= old('name') ?>">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="address">Адрес</label>
        <input class="form__input" type="text" name="address" id="address" placeholder="" value="<?= old('address') ?>">
        <?= getErrors('address') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>
<?
session()->delete('form_data');
session()->delete('form_errors');
?>