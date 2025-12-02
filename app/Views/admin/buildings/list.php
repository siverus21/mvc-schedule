<div class="block-list d-grid grid-col-4 gap-2">
    <? foreach ($data as $building): ?>
        <div class="block-list__item default-block default-block_padding">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="block-list__title"><?= $building["name"] ?></h3>
            </div>
            <div class="d-flex align-items-center gap-1 mb-1">
                <i class="icon icon_small">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </i>
                <p class="block-list__text"><?= $building["address"] ?></p>
            </div>
            <div class="block-list__footer">
                <a class="button d-flex align-items-center justify-content-center" href="<?= base_url('/admin/buildings/edit/' . $building["id"]) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                    </svg>
                    <span>Редактировать</span>
                </a>
            </div>
        </div>
    <? endforeach; ?>
</div>