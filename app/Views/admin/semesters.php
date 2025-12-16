<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Семестры</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/semesters/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/semesters/list', $semesters) ?>