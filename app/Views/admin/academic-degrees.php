<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Типы академической степени</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/academic-degrees/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/academic-degrees/list', $academicDegrees) ?>