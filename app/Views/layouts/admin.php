<!DOCTYPE html>
<html lang="en" data-theme="<?= $_COOKIE['themePreference'] ?? "" ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youpi :: <?= $title ?? "" ?></title>
    <?= getCsrfMeta(); ?>

    <link rel="stylesheet" href="<?= base_url('/public/assets/css/app.css') ?>">

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

<body class="<?= $_COOKIE['themePreference'] ?? "" ?>">
    <header class="header">
        <?= view()->renderPartial('layouts/header/header'); ?>
    </header>

    <main>
        <? if (Youpi\Auth::isAuth()): ?>
            <div class="d-flex">
                <aside class="aside">
                    <?= view()->renderPartial('incs/admin/menu'); ?>
                </aside>
                <div class="main-content w-100">
                    <?= getAlerts(); ?>
                    <?= $content ?>
                </div>
            </div>
        <? else: ?>
            <?= getAlerts(); ?>
            <?= $content ?>
        <? endif; ?>
    </main>

    <footer class="footer pt-4 pb-4">
    </footer>
    <div class="iziModal-alert-success"></div>
    <div class="iziModal-alert-error"></div>

    <script src="<?= base_url('/public/assets/js/lib.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/app.js') ?>"></script>
    <? if (!empty($footerScripts)): ?>
        <? foreach ($footerScripts as $footerScript): ?>
            <script src="<?= $footerScript; ?>"></script>
        <? endforeach; ?>
    <? endif; ?>
</body>

</html>