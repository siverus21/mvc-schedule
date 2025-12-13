<div class="d-flex justify-content-beetwen">
    <h1 class="mt-0 mb-4 lh-1">Пользователи</h1>
    <div>
        <a class="button" href="<?= base_url('/admin/users/create') ?>">Добавить</a>
    </div>
</div>

<?= view()->renderPartial('admin/users/list', ['users' => $users]) ?>