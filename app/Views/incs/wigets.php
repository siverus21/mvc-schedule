<? if (is_array($data)): ?>
    <div class="wiget d-grid grid-col-<?= count($data); ?> gap-2 w-100">
        <? foreach ($data as $wiget): ?>
            <?= $wiget ?>
        <? endforeach ?>
    </div>
<? endif; ?>