<h1 class="mt-0 mb-4 lh-1">Редактировать семестр</h1>

<form class="form" action="<?= base_url('/admin/semesters/edit/' . $semester['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название семестра</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="Лекция" value="<?= $semester['name'] ?>">
        <?= getErrors('name') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Изменить</button>
</form>