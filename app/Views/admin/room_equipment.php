<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Оборудование в аудиториях</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/room-equipment/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/room-equipment/list', $equipmentTypes) ?>