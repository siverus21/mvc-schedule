<? if (empty($data)): ?>
    <div class="block-list d-flex justify-center text-center">
        <div class="block-list__item default-block default-block_padding text-center">
            <p class="block-list__text">Нет зданий</p>
        </div>
    </div>
<? else: ?>
    <div class="block-list d-grid grid-col-3 gap-2">
        <? foreach ($data["users"] as $item): ?>
            <div class="block-list__item default-block default-block_padding">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h3 class="block-list__title"><?= $item["display_name"] ?></h3>
                    <div class="block-list__badge block-list__badge_absolute <?= $item["is_active"] ?: "block-list__badge_danger" ?>">
                        <p><?= $item["is_active"] ? "Активен" : "Не активен" ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-1 mb-1">
                    <i class="icon icon_small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield w-5 h-5 flex-shrink-0">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                        </svg>
                    </i>
                    <p class="block-list__text"><?= $item["role_name"] ?></p>
                </div>
                <div class="d-flex align-items-center gap-1 mb-1">
                    <i class="icon icon_small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                    </i>
                    <p class="block-list__text"><?= $item["email"] ?></p>
                </div>
                <div class="d-flex align-items-center gap-1 mb-1">
                    <i class="icon icon_small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </i>
                    <p class="block-list__text"><?= $item["phone"] ?? "-" ?></p>
                </div>
                <div class="block-list__footer">
                    <a class="button d-flex align-items-center justify-content-center mb-2" href="<?= base_url('/admin/users/edit/' . $item["id"]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                        </svg>
                        <span>Редактировать</span>
                    </a>
                    <a class="button button_danger d-flex align-items-center justify-content-center" href="<?= base_url('/admin/users/delete/' . $item["id"]) ?>">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Удалить</span>
                    </a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>