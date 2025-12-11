<h1 class="mt-0 mb-4 lh-1">Дашборд</h1>

<?
$wigets = [
    "countAuditories" => $countAuditories,
];
?>

<?= view()->renderPartial('incs/admin/wigets/wiget', $wigets) ?>
<div class="d-grid grid-col-2 gap-2 mt-4">
    <?= view()->renderPartial('incs/admin/wigets/last_activity') ?>
    <?= view()->renderPartial('incs/admin/wigets/next_events') ?>
</div>