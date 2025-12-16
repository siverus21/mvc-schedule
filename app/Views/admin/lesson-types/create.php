<h1 class="mt-0 mb-4 lh-1">Создать тип занятия</h1>

<form class="form" action="<?= base_url('/admin/lesson-types/create') ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="LECTION" value="<?= old('code') ?>">
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название типа занятия</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="Лекция" value="<?= old('name') ?>">
        <?= getErrors('name') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>