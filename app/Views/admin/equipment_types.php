<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Тип оборудования</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/equipment-types/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/equipment-types/list', $equipmentTypes) ?>