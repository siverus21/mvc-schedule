<h1 class="mt-0 mb-4 lh-1">Создать семестр</h1>

<form class="form" action="<?= base_url('/admin/semesters/create') ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">Название семестра</label>
        <input class="form__input" type="text" name="name" id="name" placeholder="1" value="<?= old('name') ?>">
        <?= getErrors('name') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>