<?
$activities = array(
    0 => array(
        'event' => 'Создана пара "Математический анализ"',
        'time' => '10 минут назад',
        'user' => 'Администратор'
    ),
    1 => array(
        'event' => 'Обновлены данные преподавателя',
        'time' => '25 минут назад',
        'user' => 'Редактор'
    ),
    2 => array(
        'event' => 'Импортировано 45 пар',
        'time' => '1 час назад',
        'user' => 'Администратор'
    ),
    3 => array(
        'event' => 'Добавлена аудитория "Ауд. 420"',
        'time' => '2 часа назад',
        'user' => 'Администратор'
    )
);
?>

<div class="wiget wiget_padding default-block">
    <div class="wiget__header d-flex align-items-center gap-2 mb-2">
        <i class="icon icon_purple">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-6 h-6">
                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                <polyline points="16 7 22 7 22 13"></polyline>
            </svg>
        </i>
        <h3 class="wiget__title">Последняя активность</h3>
    </div>
    <? foreach ($activities as $activity): ?>
        <div class="wiget__item wiget__item_border wiget__item_badge">
            <p class="wiget__event"><?= $activity['event'] ?></p>
            <div class="d-flex gap-1">
                <p class="wiget__time"><?= $activity['time'] ?></p>
                <p class="wiget__dot">•</p>
                <p class="wiget__user"><?= $activity['user'] ?></p>
            </div>
        </div>
    <? endforeach; ?>
</div>