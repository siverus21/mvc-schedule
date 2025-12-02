<h1 class="mt-0 mb-4 lh-1">Создать аудиторию</h1>

<form class="form" action="<?= base_url('/admin/auditories/create') ?>" method="post">
    <?= getCsrfField(); ?>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="email">Email</label>
        <input class="form__input <?= getValidationClass('email') ?>" type="email" name="email" id="email" placeholder="name@example.com" value="<?= old('email') ?>">
        <?= getErrors('email') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="password">Password</label>
        <input class="form__input <?= getValidationClass('password') ?>" type="password" name="password" id="password" placeholder="password">
        <?= getErrors('password') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Вход</button>
</form>
<?
session()->delete('form_data');
session()->delete('form_errors');
?>