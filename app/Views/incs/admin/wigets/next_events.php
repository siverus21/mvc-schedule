<?
$arEvents = array(
    0 => array(
        "title" => "Математический анализ",
        "time" => "Сегодня, 14:00",
        "teacher" => "Иванов И.И.",
        "room" => "Ауд. 101",
    ),
    1 => array(
        "title" => "Программирование 1",
        "time" => "Завтра, 09:00",
        "teacher" => "Петрова А.В.",
        "room" => "Комп. класс 1",
    ),
    2 => array(
        "title" => "Физика",
        "time" => "Завтра, 10:45",
        "teacher" => "Белова О.Н.",
        "room" => "Ауд. 220",
    ),
);
?>

<div class="wiget wiget_padding default-block">
    <div class="wiget__header d-flex align-items-center gap-2 mb-2">
        <i class="icon icon_purple">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </i>
        <h3 class="wiget__title">Предстоящие занятия</h3>
    </div>
    <? foreach ($arEvents as $event): ?>
        <div class="wiget__item wiget__item_border">
            <p class="wiget__event wiget__event_bold"><?= $event['title'] ?></p>
            <p class="wiget__time wiget__time_blue"><?= $event['time'] ?></p>
            <div class="d-flex gap-1">
                <p class="wiget__user"><?= $event['teacher'] ?></p>
                <p class="wiget__dot">•</p>
                <p class="wiget__room"><?= $event['room'] ?></p>
            </div>
        </div>
    <? endforeach; ?>
</div>