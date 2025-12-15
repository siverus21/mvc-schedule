<? if (empty($data)): ?>
    <div class="block-list d-flex justify-center text-center">
        <div class="block-list__item default-block default-block_padding text-center">
            <p class="block-list__text">Нет кафедр</p>
        </div>
    </div>
<? else: ?>
    <div class="block-list d-grid grid-col-4 gap-2">
        <? foreach ($data as $item): ?>
            <div class="block-list__item default-block default-block_padding">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h3 class="block-list__title"><?= $item["name"] ?></h3>
                </div>
                <? if ($item["notes"]): ?>
                    <div class="d-flex align-items-center justify-content-between mb-2 gap-2">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40974 4.40973 4.7157 4.21799 5.09202C4 5.51985 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H16.8C17.9201 20 18.4802 20 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V12.5M15.5 5.5L18.3284 8.32843M10.7627 10.2373L17.411 3.58902C18.192 2.80797 19.4584 2.80797 20.2394 3.58902C21.0205 4.37007 21.0205 5.6364 20.2394 6.41745L13.3774 13.2794C12.6158 14.0411 12.235 14.4219 11.8012 14.7247C11.4162 14.9936 11.0009 15.2162 10.564 15.3882C10.0717 15.582 9.54378 15.6885 8.48793 15.9016L8 16L8.04745 15.6678C8.21536 14.4925 8.29932 13.9048 8.49029 13.3561C8.65975 12.8692 8.89125 12.4063 9.17906 11.9786C9.50341 11.4966 9.92319 11.0768 10.7627 10.2373Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <spam><?= $item["notes"] ?></spam>
                    </div>
                <? endif; ?>
                <div class="block-list__footer">
                    <a class="button d-flex align-items-center justify-content-center mb-2" href="<?= base_url('/admin/department/edit/' . $item["id"]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                        </svg>
                        <span>Редактировать</span>
                    </a>
                    <a class="button button_danger d-flex align-items-center justify-content-center" href="<?= base_url('/admin/department/delete/' . $item["id"]) ?>">
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