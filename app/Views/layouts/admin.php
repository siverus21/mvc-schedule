<!DOCTYPE html>
<html lang="en" data-theme="<?= $_COOKIE['themePreference'] ?? "" ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youpi :: <?= $title ?? "" ?></title>
    <?= getCsrfMeta(); ?>
    <link rel="stylesheet" href="<?= asset_url('assets/css/vendors.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('assets/css/app.css') ?>">

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
                    <div class="alerts-container">
                        <? getAlerts(); ?>
                    </div>
                    <?= $content ?>
                </div>
            </div>
        <? else: ?>
            <div class="alerts-container">
                <? getAlerts(); ?>
            </div>
            <?= $content ?>
        <? endif; ?>
    </main>

    <footer class="footer pt-4 pb-4">
    </footer>
    <div class="iziModal-alert-success"></div>
    <div class="iziModal-alert-error"></div>

    <script src="<?= asset_url('assets/js/lib.js') ?>"></script>
    <script src="<?= asset_url('assets/js/vendors.js') ?>"></script>
    <script src="<?= asset_url('assets/js/app.js') ?>"></script>
    <? if (!empty($footerScripts)): ?>
        <? foreach ($footerScripts as $footerScript): ?>
            <script src="<?= $footerScript; ?>"></script>
        <? endforeach; ?>
    <? endif; ?>
</body>

</html>