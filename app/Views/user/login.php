<div class="login mt-4 mb-4">

    <h1 class="login__title mb-4 text-center">Вход</h1>

    <form class="form" action="<?= base_url('/login') ?>" method="post">
        <?= getCsrfField(); ?>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="email">Email</label>
            <input class="form__input <?= getValidationClass('email') ?>" type="email" name="email" id="email" placeholder="name@example.com" value="<?= old('email') ?>">
            <?= getErrors('email') ?>
        </div>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="password">Password</label>
            <input class="form__input <?= getValidationClass('password') ?>" type="password" name="password" id="password" placeholder="password" autocomplete="on">
            <?= getErrors('password') ?>
        </div>
        <button type="submit" class="button button_primary w-100 mt-4">Вход</button>
    </form>
    <?
    session()->delete('form_data');
    session()->delete('form_errors');
    ?>

</div>