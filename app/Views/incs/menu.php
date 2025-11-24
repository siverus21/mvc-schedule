<ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-menu">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_url('/'); ?>">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_url('/dashboard'); ?>">Dashboard</a>
    </li>
    <? if (checkAuth()): ?>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('/logout'); ?>">Logout</a>
        </li>
    <? else: ?>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('/register'); ?>">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('/login'); ?>">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('/users'); ?>">Users</a>
        </li>
    <? endif; ?>
</ul>