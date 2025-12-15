<h1 class="mt-0 mb-4 lh-1">Редактировать тип академической степени</h1>

<form class="form" action="<?= base_url('/admin/academic-degrees/edit/' . $academicDegree['id']) ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="code">Код</label>
        <input class="form__input" type="text" name="code" id="code" placeholder="DOCENT" value="<?= $academicDegree['code'] ?>">
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название типа академической степени</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="Доцент" value="<?= $academicDegree['name'] ?>">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="notes">Описание</label>
        <input class="form__input" type="text" name="notes" id="notes" placeholder="Описание..." value="<?= $academicDegree['notes'] ?>">
        <?= getErrors('notes') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Сохранить</button>
</form>