<div class="container">
    <ul>
        <? foreach ($users as $user): ?>
            <li>
                <a href="<?= base_url('/users/' . $user['id']) ?>">
                    <?= $user['name'] ?>
                </a>
            </li>
        <? endforeach ?>
    </ul>

    <?= $pagination ?>
</div>