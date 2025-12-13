<h1 class="mt-0 mb-4 lh-1">Создать нового пользователя</h1>
<form class="form" action="<?= base_url('/admin/users/create') ?>" method="post">
    <?= getCsrfField(); ?>

    <div class="form__group d-flex flex-column">
        <label class="form__label" for="name">ФИО</label>
        <input class="form__input <?= getValidationClass('name') ?>" type="text" name="name" id="name" placeholder="Иванов Александр Александрович" value="<?= old('name') ?>">
        <?= getErrors('name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="display_name">Отображаемое имя</label>
        <input class="form__input <?= getValidationClass('display_name') ?>" type="text" name="display_name" id="display_name" placeholder="Иванов А.А." value="<?= old('display_name') ?>">
        <?= getErrors('display_name') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="email">Email</label>
        <input class="form__input <?= getValidationClass('email') ?>" type="email" name="email" id="email" placeholder="name@example.com" value="<?= old('email') ?>">
        <?= getErrors('email') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="phone">Номер телефона</label>
        <input class="form__input <?= getValidationClass('phone') ?>" type="text" name="phone" id="phone" placeholder="+7 (999) 999-99-99" value="<?= old('phone') ?>">
        <?= getErrors('phone') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="role_id">Роль</label>
        <select class="form__select <?= getValidationClass('role_id') ?>" name="role_id" id="role_id">
            <? $oldRole = old('role_id'); ?>
            <? if (!$oldRole): ?>
                <option value="" selected disabled>Выберите роль пользователя</option>
            <? endif; ?>
            <? foreach ($roles as $role): ?>
                <option value="<?= $role['id'] ?>" <?= $oldRole == $role['id'] ? 'selected' : '' ?>>
                    <?= $role['name'] ?>
                </option>
            <? endforeach ?>
        </select>
        <?= getErrors('role_id') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="password">Пароль</label>
        <input class="form__input <?= getValidationClass('password') ?>" type="password" name="password" id="password" placeholder="Пароль">
        <?= getErrors('password') ?>
    </div>
    <div class="form__group d-flex flex-column">
        <label class="form__label" for="confirm-password">Подтвердите пароль</label>
        <input class="form__input <?= getValidationClass('confirm-password') ?>" type="password" name="confirm-password" id="confirm-password" placeholder="Подтвердите пароль">
        <?= getErrors('confirm-password') ?>
    </div>
    <button type="submit" class="button button_primary w-100 mt-4">Создать</button>
</form>