<nav aria-label="Page navigation example">
    <ul class="pagination">

        <? if (!empty($firstPage)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $firstPage; ?>" aria-label="First page">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <? endif; ?>

        <? if (!empty($prev)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $prev; ?>" aria-label="Previous page">
                    <span aria-hidden="true">&lt;</span>
                </a>
            </li>
        <? endif; ?>

        <? if (!empty($pagesLeft)): ?>
            <? foreach ($pagesLeft as $page_left): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $page_left['link']; ?>">
                        <?= $page_left['number']; ?>
                    </a>
                </li>
            <? endforeach; ?>
        <? endif; ?>

        <li class="page-item active"><a class="page-link"><?= $currentPage; ?></a></li>

        <? if (!empty($pagesRight)): ?>
            <? foreach ($pagesRight as $page_right): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $page_right['link']; ?>">
                        <?= $page_right['number']; ?>
                    </a>
                </li>
            <? endforeach; ?>
        <? endif; ?>

        <? if (!empty($next)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $next; ?>" aria-label="Next page">
                    <span aria-hidden="true">&gt;</span>
                </a>
            </li>
        <? endif; ?>

        <? if (!empty($lastPage)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $lastPage; ?>" aria-label="Last page">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <? endif; ?>

    </ul>
</nav>