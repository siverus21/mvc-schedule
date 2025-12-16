<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Учебные группы</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/student-groups/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/student-groups/list', $studentGroups) ?>