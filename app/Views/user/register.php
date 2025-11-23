<div class="container">

    <h1><?= $title ?? "" ?></h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form class="ajax-form" action="<?= base_url('/register') ?>" method="post">
                <?= getCsrfField(); ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control <?= getValidationClass('name') ?>" type="text" name="name" id="name" placeholder="name" value="<?= old('name') ?>">
                    <?= getErrors('name') ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control <?= getValidationClass('email') ?>" type="email" name="email" id="email" placeholder="name@example.com" value="<?= old('email') ?>">
                    <?= getErrors('email') ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control <?= getValidationClass('password') ?>" type="password" name="password" id="password" placeholder="password">
                    <?= getErrors('password') ?>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm-password</label>
                    <input class="form-control <?= getValidationClass('confirm-password') ?>" type="password" name="confirm-password" id="confirm-password" placeholder="confirm password">
                    <?= getErrors('confirm-password') ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?
            session()->delete('form_data');
            session()->delete('form_errors');
            ?>
        </div>
    </div>

</div>