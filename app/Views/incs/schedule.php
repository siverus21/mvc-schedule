<div class="schedule">
    <? if (empty($data)): ?>
        <div class="d-flex justify-center">
            <p>Нет расписания</p>
        </div>
    <? else: ?>
        <div class="schedule__select">
            <button class="button button_active js-schedule-select-week">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-grid w-4 h-4" aria-hidden="true">
                    <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                    <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                    <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                    <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                </svg>
                <span>Неделя</span>
            </button>
            <button class="button js-schedule-select-day">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4" aria-hidden="true">
                    <path d="M8 2v4"></path>
                    <path d="M16 2v4"></path>
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M3 10h18"></path>
                </svg>
                <span>День</ы>
            </button>
        </div>
        <div class="schedule__content">
            <div class="schedule__week js-schedule-week">
                <? foreach ($data['list']['days'] as $key => $item): ?>
                    <div class="schedule__day">
                        <div class="schedule__item default-block">
                            <div class="schedule__header">
                                <h4 class="schedule__title"><?= $key ?></h4>
                                <? $count = count($item) ?>
                                <?
                                $text = 'пар';
                                if ($count == 1) {
                                    $text = 'пара';
                                } elseif ($count > 1 && $count < 5) {
                                    $text = 'пары';
                                }
                                ?>
                                <p class="schedule__pairs"><span class="js-pairs-count"><?= $count ?></span> <?= $text ?></p>
                            </div>
                            <div class="schedule__body">
                                <? if ($count == 0): ?>
                                    <p style="text-align: center;">Нет пар</p>
                                <? else: ?>
                                    <? foreach ($item as $schedule): ?>
                                        <div class="schedule__block <?= $schedule['lesson_type_code'] ? "schedule__block_" . $schedule['lesson_type_code'] : "" ?>">
                                            <div class="schedule__time">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4" aria-hidden="true" style="color: rgb(99, 102, 241);">
                                                    <path d="M12 6v6l4 2"></path>
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                                <p><?= date('H:i', strtotime($schedule['start_time'])) ?></p>
                                                <span>-</span>
                                                <p><?= date('H:i', strtotime($schedule['end_time'])) ?></p>
                                            </div>
                                            <? if ($schedule['week_parity'] > 0): ?>
                                                <p class="schedule__name"><?= $data['weekParity'][$schedule['week_parity']] ?></p>
                                            <? endif; ?>
                                            <div class="schedule__type">
                                                <p><?= $schedule['lesson_type_name'] ?></p>
                                            </div>
                                            <div class="schedule__name">
                                                <p class="schedule__subject"><?= $schedule['subject_name'] ?></p>
                                            </div>
                                            <div class="schedule__teacher">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4" aria-hidden="true" style="color: var(--color-text-secondary);">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <p><?= $schedule['teacher_name'] ?></p>
                                            </div>
                                            <div class="schedule__room">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4" aria-hidden="true" style="color: var(--color-text-secondary);">
                                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <p><?= $schedule['room_name'] ?></p>
                                            </div>
                                            <?/* if ($randClass == "schedule__block_cancelled" || $randClass == "schedule__block_replacement"): ?>
                                                <div class="schedule__info">
                                                    <p><?= $infoText[$randClass] ?></p>
                                                </div>
                                            <? endif;   */ ?>
                                        </div>
                                    <? endforeach; ?>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                <? endforeach;   ?>
            </div>
        </div>
    <? endif; ?>
</div>