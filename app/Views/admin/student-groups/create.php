<h1 class="mt-0 mb-4 lh-1">Создать учебную группу</h1>

<form class="form" action="<?= base_url('/admin/student-groups/create') ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="ISIT-1" value="<?= old('code') ?>">
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название учебной группы</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="ИСИТ-1-2021" value="<?= old('name') ?>">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="program">Образовательная программа/специальность</label>
        <input class="form__input" type="text" name="program" id="program" placeholder="Компьютерные науки" value="<?= old('program') ?>">
        <?= getErrors('program') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="notes">Описание</label>
        <input class="form__input" type="text" name="notes" id="notes" placeholder="Поток А" value="<?= old('notes') ?>">
        <?= getErrors('notes') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>