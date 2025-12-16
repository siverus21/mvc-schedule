<h1 class="mt-0 mb-4 lh-1">Редактирование типа аудитории</h1>

<form class="form" action="<?= base_url('/admin/lesson-types/edit/' . $lessonType['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="" value="<?= $lessonType['code'] ?>">
        <?= getErrors('code') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название типа аудитории</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="" value="<?= $lessonType['name'] ?>">
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Изменить</button>
</form>