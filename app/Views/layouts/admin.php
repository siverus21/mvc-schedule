<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youpi :: <?= $title ?? "" ?></title>
    <?= getCsrfMeta(); ?>
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/iziModal.min.css') ?>">
    <? if (!empty($styles)): ?>
        <? foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= $style; ?>">
        <? endforeach; ?>
    <? endif; ?>

    <? if (!empty($headerScripts)): ?>
        <? foreach ($headerScripts as $headerScript): ?>
            <script src="<?= $headerScript; ?>"></script>
        <? endforeach; ?>
    <? endif; ?>

</head>

<body>
    <header>

    </header>

    <main>
        <?= getAlerts(); ?>
        <?= $content ?>
    </main>

    <footer>
    </footer>

    <script src="<?= base_url('/public/assets/js/jqeury.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="<?= base_url('/public/assets/js/iziModal.min.js') ?>"></script>

    <? if (!empty($footerScripts)): ?>
        <? foreach ($footerScripts as $footerScript): ?>
            <script src="<?= $footerScript; ?>"></script>
        <? endforeach; ?>
    <? endif; ?>

    <script src="<?= base_url('/public/assets/js/app.js') ?>"></script>
    <div class="iziModal-alert-success"></div>
    <div class="iziModal-alert-error"></div>

</body>

</html>