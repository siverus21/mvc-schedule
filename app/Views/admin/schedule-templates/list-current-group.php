<? //dd($list);
?>
<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Расписание для группы <?= $list['group_name'] ?> (<?= $list["group_notes"] ?>)
    </h1>
</div>

<? foreach ($list["days"] as $day => $schedule): ?>
    <div class="block-list__item default-block default-block_padding">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="block-list__title"><?= $day ?></h3>
        </div>
        <div class="d-grid grid-col-6 align-items-center mb-2 pb-2 border-bottom-1">
            <p class="block-list__title">Название пары</p>
            <p class="block-list__title">Аудитория</p>
            <p class="block-list__title">Преподаватель</p>
            <p class="block-list__title">Время</p>
            <p class="block-list__title">Тип занятия</p>
            <p class="block-list__title">Функции</p>
        </div>
        <? foreach ($schedule["schedules"] as $item): ?>
            <div class="d-grid grid-col-6 align-items-center mb-2 pb-2 <?= $item["id"] !== array_last($schedule["schedules"])["id"] ? "border-bottom-1" : "" ?>">
                <div class="d-flex">
                    <p class="block-list__title"><?= $item["subject_name"] ?></p>
                </div>
                <div class="d-flex">
                    <p class="block-list__title"><?= $item["room_name"] ?></p>
                </div>
                <div class="d-flex">
                    <p class="block-list__title"><?= $item["teacher_name"] ?></p>
                </div>
                <div class="d-flex">
                    <p class="block-list__title"><?= $item["start_time"] ?> - <?= $item["end_time"] ?></p>
                </div>
                <div class="d-flex">
                    <p class="block-list__title"><?= $item["lesson_type_name"] ?></p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a class="button d-flex align-items-center justify-content-center" href="<? //= base_url('/admin/room-equipment/edit/' . $item["id"]) 
                                                                                                ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                        </svg>
                        <span>Редактировать</span>
                    </a>
                    <a class="button button_danger d-flex align-items-center justify-content-center" href="<? //= base_url('/admin/room-equipment/delete/' . $item["id"]) 
                                                                                                            ?>">
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