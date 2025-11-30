<div class="register">

    <h1 class="register__title mb-4 text-center">Регистрация</h1>

    <form class="form" action="<?= base_url('/register') ?>" method="post">
        <?= getCsrfField(); ?>

        <div class="form__group d-flex flex-column">
            <label class="form__label" for="name">Имя</label>
            <input class="form__input <?= getValidationClass('name') ?>" type="text" name="name" id="name" placeholder="name" value="<?= old('name') ?>">
            <?= getErrors('name') ?>
        </div>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="email">Email</label>
            <input class="form__input <?= getValidationClass('email') ?>" type="email" name="email" id="email" placeholder="name@example.com" value="<?= old('email') ?>">
            <?= getErrors('email') ?>
        </div>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="password">Пароль</label>
            <input class="form__input <?= getValidationClass('password') ?>" type="password" name="password" id="password" placeholder="password">
            <?= getErrors('password') ?>
        </div>
        <div class="form__group d-flex flex-column">
            <label class="form__label" for="confirm-password">Подтвердите пароль</label>
            <input class="form__input <?= getValidationClass('confirm-password') ?>" type="password" name="confirm-password" id="confirm-password" placeholder="confirm password">
            <?= getErrors('confirm-password') ?>
        </div>
        <button type="submit" class="button button_primary w-100 mt-4">Регистрация</button>
    </form>
    <?
    session()->delete('form_data');
    session()->delete('form_errors');
    ?>
</div>