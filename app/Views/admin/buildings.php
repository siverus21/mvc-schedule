<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Здания</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/buildings/create') ?>">Добавить</a>
    </div>
</div>
<?
$arBuildings = array(
    0 => array(
        'TITLE' => 'Здание 1',
        'LOCATION' => 'г. Москва, ул. Пушкинская, д. 1',
    ),
    1 => array(
        'TITLE' => 'Здание 2',
        'LOCATION' => 'г. Москва, ул. Пушкинская, д. 2',
    ),
    2 => array(
        'TITLE' => 'Здание 3',
        'LOCATION' => 'г. Москва, ул. Пушкинская, д. 3',
    ),
);
?>

<?= view()->renderPartial('admin/buildings/list', $arBuildings) ?>