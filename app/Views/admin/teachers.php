<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Преподаватели</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/teachers/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/teachers/list', $teachers) ?>