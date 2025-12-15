<? if (empty($data)): ?>
    <div class="block-list d-flex justify-center text-center">
        <div class="block-list__item default-block default-block_padding text-center">
            <p class="block-list__text">Нет преподавателей</p>
        </div>
    </div>
<? else: ?>
    <div class="block-list d-grid grid-col-4 gap-2">
        <? foreach ($data as $item): ?>
            <div class="block-list__item default-block default-block_padding">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h3 class="block-list__title"><?= $item["name"] ?></h3>
                </div>
                <? if ($item["academic_degree"]): ?>
                    <div class="d-flex align-items-center justify-content-between mb-2 gap-2">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.05 2.53004L4.03002 6.46004C2.10002 7.72004 2.10002 10.54 4.03002 11.8L10.05 15.73C11.13 16.44 12.91 16.44 13.99 15.73L19.98 11.8C21.9 10.54 21.9 7.73004 19.98 6.47004L13.99 2.54004C12.91 1.82004 11.13 1.82004 10.05 2.53004Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5.63 13.08L5.62 17.77C5.62 19.04 6.6 20.4 7.8 20.8L10.99 21.86C11.54 22.04 12.45 22.04 13.01 21.86L16.2 20.8C17.4 20.4 18.38 19.04 18.38 17.77V13.13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.4 15V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <spam><?= $item["academic_degree"] ?></spam>
                    </div>
                <? endif; ?>
                <? if ($item["department"]): ?>
                    <div class="d-flex align-items-center justify-content-between mb-2 gap-2">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z" fill="currentColor"> </path>
                        </svg>
                        <spam><?= $item["department"] ?></spam>
                    </div>
                <? endif; ?>
                <? if ($item["email"]): ?>
                    <div class="d-flex align-items-center justify-content-between mb-2 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <spam><?= $item["email"] ?></spam>
                    </div>
                <? endif; ?>
                <div class="block-list__footer">
                    <a class="button d-flex align-items-center justify-content-center mb-2" href="<?= base_url('/admin/teachers/edit/' . $item["id"]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                        </svg>
                        <span>Редактировать</span>
                    </a>
                    <a class="button button_danger d-flex align-items-center justify-content-center" href="<?= base_url('/admin/teachers/delete/' . $item["id"]) ?>">
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