<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Аудитории</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/auditories/create') ?>">Добавить</a>
    </div>
</div>
<?
// $arAuditores = array(
//     0 => array(
//         "TITLE" => "101",
//         "LOCATION" => "Главный корпус",
//         "CAPACITY" => "100",
//         "EQUIPMENT" => array('Проектор', 'Доска', 'Микрофон'),
//         "TYPE" => "Лекционная",
//     ),
//     1 => array(
//         "TITLE" => "205",
//         "LOCATION" => "Главный корпус",
//         "CAPACITY" => "30",
//         "EQUIPMENT" => array('Доска', 'Телевизор'),
//         "TYPE" => "Семинарская",
//     ),
//     2 => array(
//         "TITLE" => "312",
//         "LOCATION" => "Главный корпус",
//         "CAPACITY" => "80",
//         "EQUIPMENT" => array('Проектор', 'Доска',),
//         "TYPE" => "Лекционная",
//     ),
//     3 => array(
//         "TITLE" => "Комп. класс 1",
//         "LOCATION" => "Корпус 2",
//         "CAPACITY" => "25",
//         "EQUIPMENT" => array('25 компьютеров', 'Проектор', 'Интерактивная доска'),
//         "TYPE" => "Компьютерный класс",
//     ),
//     4 => array(
//         "TITLE" => "Комп. класс 2",
//         "LOCATION" => "Корпус 2",
//         "CAPACITY" => "25",
//         "EQUIPMENT" => array('25 компьютеров', 'Проектор'),
//         "TYPE" => "Компьютерный класс",
//     ),
//     5 => array(
//         "TITLE" => "Лаборатория 3",
//         "LOCATION" => "Корпус 3",
//         "CAPACITY" => "20",
//         "EQUIPMENT" => array('Лабораторное оборудование', 'Вытяжки', 'Защитные средства'),
//         "TYPE" => "Лаборатория",
//     ),
//     6 => array(
//         "TITLE" => "Спортзал",
//         "LOCATION" => "Спортивный комплекс",
//         "CAPACITY" => "50",
//         "EQUIPMENT" => array('Волейбольная сетка', 'Баскетбольные кольца', 'Гимнастические маты'),
//         "TYPE" => "Спортзал",
//     ),
// );
?>
<?= view()->renderPartial('admin/auditories/list', $auditories) ?>