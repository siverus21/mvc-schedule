<?
$groupName = "";
$groupNotes = "";

if (isset($list['group_name'])) {
    $groupName = $list['group_name'];
    $groupNotes = isset($list['group_notes']) ? $list['group_notes'] : "";
} elseif (isset($groupData['name'])) {
    $groupName = $groupData['name'];
    $groupNotes = isset($groupData['notes']) ? $groupData['notes'] : "";
}
?>

<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Расписание для группы <?= $groupName ?> <?= $groupNotes ? "({$groupNotes})" : "" ?></h1>
    <div>
        <a class="button" href="<?= base_url("/admin/schedules/semester/{$semesterId}/group/{$groupId}/create") ?>">Добавить</a>
    </div>
</div>

<? if (isset($list["days"])): ?>
    <? foreach ($list["days"] as $day => $schedule): ?>
        <div class="block-list__item default-block default-block_padding mb-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="block-list__title"><?= $day ?></h3>
            </div>
            <div class="d-grid grid-col-6 align-items-center justify-center mb-2 pb-2 border-bottom-1">
                <p class="block-list__title text-center">Название пары</p>
                <p class="block-list__title text-center">Аудитория</p>
                <p class="block-list__title text-center">Преподаватель</p>
                <p class="block-list__title text-center">Время</p>
                <p class="block-list__title text-center">Тип занятия</p>
                <p class="block-list__title text-center">Функции</p>
            </div>
            <? foreach ($schedule["schedules"] as $item): ?>
                <div class="d-grid grid-col-6 align-items-center mb-2 pb-2 <?= $item["id"] !== array_last($schedule["schedules"])["id"] ? "border-bottom-1" : "" ?>">
                    <div class="d-flex justify-center">
                        <p class="block-list__title text-center"><?= $item["subject_name"] ?></p>
                    </div>
                    <div class="d-flex justify-center">
                        <p class="block-list__title text-center"><?= $item["room_name"] ?></p>
                    </div>
                    <div class="d-flex justify-center">
                        <p class="block-list__title text-center"><?= $item["teacher_name"] ?></p>
                    </div>
                    <div class="d-flex justify-center">
                        <p class="block-list__title text-center"><?= date("H:i", strtotime($item["start_time"])) ?> - <?= date("H:i", strtotime($item["end_time"])) ?></p>
                    </div>
                    <div class="d-flex justify-center">
                        <p class="block-list__title text-center"><?= $item["lesson_type_name"] ?></p>
                    </div>
                    <div class="d-flex flex-column align-items-center gap-2">
                        <a class="button d-flex align-items-center justify-center" href="<?= base_url("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $item["id"]) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                            </svg>
                            <span>Редактировать</span>
                        </a>
                        <a class="button button_danger d-flex align-items-center justify-content-center" href="<?= base_url("/admin/schedules/semester/{$semesterId}/group/{$groupId}/delete/" . $item["id"]) ?>">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span>Удалить</span>
                        </a>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    <? endforeach; ?>
<? else: ?>
    <div class="block-list d-flex justify-center text-center">
        <div class="block-list__item default-block default-block_padding text-center">
            <p class="block-list__text">Нет расписаний</p>
        </div>
    </div>
<? endif; ?>