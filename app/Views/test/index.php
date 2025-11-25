<div class="container">

    <h1><?= $title ?? "" ?></h1>

    <div>
        <?= $menu ?>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form class="" action="<?= base_url('/test') ?>" method="post" enctype="multipart/form-data">
                <?= getCsrfField(); ?>
                <div class="mb-3">
                    <label for="file" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="file" name="file">
                </div>
                <div class="mb-3">
                    <label for="files" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="files" name="files[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

</div>