<?
$arLeftMenu = array(
    0 => array(
        "TITLE" => "Дашборд",
        "LINK"  => base_url("/admin/dashboard"),
        "ICON"  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-5 h-5 flex-shrink-0"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    1 => array(
        "TITLE" => "Расписание",
        "LINK" => base_url("/admin/schedule"),
        "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 flex-shrink-0"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    2 => array(
        "TITLE" => "Преподаватели",
        "LINK" => base_url("/admin/teachers"),
        "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 flex-shrink-0"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    3 => array(
        "TITLE" => "Аудитории",
        "LINK" => base_url("/admin/auditories"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open w-5 h-5 flex-shrink-0"><path d="M13 4h3a2 2 0 0 1 2 2v14"></path><path d="M2 20h3"></path><path d="M13 20h9"></path><path d="M10 12v.01"></path><path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    4 => array(
        "TITLE" => "Импорт/Экспорт",
        "LINK" => base_url("/admin/import-export"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload w-5 h-5 flex-shrink-0"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    5 => array(
        "TITLE" => "Журнал действий",
        "LINK" => base_url("/admin/journal"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5 flex-shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    6 => array(
        "TITLE" => "Роли и права",
        "LINK" => base_url("/admin/roles"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield w-5 h-5 flex-shrink-0"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    ),
    7 => array(
        "TITLE" => "Настройки",
        "LINK" => base_url("/admin/settings"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings w-5 h-5 flex-shrink-0"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
    )
);

?>
<nav class="nav w-100">
    <ul class="menu d-flex flex-column gap-2">
        <? foreach ($arLeftMenu as $key => $item): ?>
            <li class="menu__item">
                <a class="menu__link d-flex align-items-center gap-2" href="<?= $item['LINK']; ?>">
                    <span class="menu__icon">
                        <?= $item['ICON']; ?>
                    </span>
                    <span class="menu__title">
                        <?= $item['TITLE']; ?>
                    </span>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
</nav>