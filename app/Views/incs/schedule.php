<div class="schedule">
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
            <? $days = array(
                0 => 'Понедельник',
                1 => 'Вторник',
                2 => 'Среда',
                3 => 'Четверг',
                4 => 'Пятница',
                5 => 'Суббота',
                6 => 'Воскресенье',
            );
            $colors = array(
                0 => 'schedule__block_lecture',
                1 => 'schedule__block_practice',
                2 => 'schedule__block_lab',
                3 => 'schedule__block_seminar',
                4 => 'schedule__block_replacement',
                5 => 'schedule__block_cancelled',
                6 => 'schedule__block_online',
            );

            $infoText = array(
                "schedule__block_cancelled" => "Занятие отменено. Следующее занятие в пятницу.",
                "schedule__block_replacement" => "Замена: вместо Николаева П.С. - Сидорова Е.И.",
            );
            ?>
            <? for ($i = 0; $i < 7; $i++): ?>
                <div class="schedule__day">
                    <div class="schedule__item">
                        <?
                        $count = rand(0, 4);
                        ?>
                        <div class="schedule__header">
                            <h4 class="schedule__title"><?= $days[$i] ?></h4>
                            <p class="schedule__pairs"><span class="js-pairs-count"><?= $count ?></span> пары</p>
                        </div>
                        <div class="schedule__body">
                            <? if ($count == 0): ?>
                                <p style="text-align: center;">Нет пар</p>
                            <? else: ?>
                                <? for ($j = 0; $j < $count; $j++): ?>
                                    <? $randClass = $colors[rand(0, 6)] ?>
                                    <div class="schedule__block <?= $randClass ?>">
                                        <div class="schedule__time">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4" aria-hidden="true" style="color: rgb(99, 102, 241);">
                                                <path d="M12 6v6l4 2"></path>
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                            <p>8:00</p>
                                            <span>-</span>
                                            <p>9:00</p>
                                        </div>
                                        <div class="schedule__type">
                                            <p>Лекция</p>
                                        </div>
                                        <div class="schedule__name">
                                            <p class="schedule__subject">Математика</p>
                                        </div>
                                        <div class="schedule__teacher">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4" aria-hidden="true" style="color: var(--color-text-secondary);">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <p>Иванов</p>
                                        </div>
                                        <div class="schedule__room">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4" aria-hidden="true" style="color: var(--color-text-secondary);">
                                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <p>101</p>
                                        </div>
                                        <? if ($randClass == "schedule__block_cancelled" || $randClass == "schedule__block_replacement"): ?>
                                            <div class="schedule__info">
                                                <p><?= $infoText[$randClass] ?></p>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                <? endfor; ?>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            <? endfor; ?>
        </div>
    </div>
</div>