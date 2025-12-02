<div class="block-list d-grid grid-col-4 gap-2">
    <? foreach ($data as $auditory): ?>
        <div class="block-list__item default-block default-block_padding">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="block-list__title"><?= $auditory["TITLE"] ?></h3>
                <? if ($auditory['TYPE']): ?>
                    <div class="block-list__badge block-list__badge_absolute">
                        <p><?= $auditory["TYPE"] ?></p>
                    </div>
                <? endif; ?>
            </div>
            <div class="d-flex align-items-center gap-1 mb-1">
                <i class="icon icon_small">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </i>
                <p class="block-list__text"><?= $auditory["LOCATION"] ?></p>
            </div>
            <div class="d-flex align-items-center gap-1 mb-1">
                <i class="icon icon_small">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </i>
                <p class="block-list__text">Вместимость: <?= $auditory["CAPACITY"] ?> чел.</p>
            </div>
            <div class="d-flex align-items-center gap-1 mb-1">
                <i class="icon icon_small">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                        <path d="M12 22V12"></path>
                        <polyline points="3.29 7 12 12 20.71 7"></polyline>
                        <path d="m7.5 4.27 9 5.15"></path>
                    </svg>
                </i>
                <p class="block-list__text">Оборудование</p>
            </div>
            <div class="d-flex align-items-center flex-wrap gap-1">
                <? foreach ($auditory['EQUIPMENT'] as $equipment): ?>
                    <div class="block-list__badge">
                        <p><?= $equipment ?></p>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <? endforeach; ?>
</div>