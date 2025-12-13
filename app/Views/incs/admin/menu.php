<?
$arLeftMenu = array(
    array(
        "TITLE" => "Дашборд",
        "LINK"  => base_url("/admin/dashboard"),
        "ICON"  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-5 h-5 flex-shrink-0"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Главное",
    ),
    array(
        "TITLE" => "Расписание",
        "LINK" => base_url("/admin/schedule"),
        "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 flex-shrink-0"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
    ),
    array(
        "TITLE" => "Преподаватели",
        "LINK" => base_url("/admin/teachers"),
        "ICON" => '<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.05 2.53004L4.03002 6.46004C2.10002 7.72004 2.10002 10.54 4.03002 11.8L10.05 15.73C11.13 16.44 12.91 16.44 13.99 15.73L19.98 11.8C21.9 10.54 21.9 7.73004 19.98 6.47004L13.99 2.54004C12.91 1.82004 11.13 1.82004 10.05 2.53004Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.63 13.08L5.62 17.77C5.62 19.04 6.6 20.4 7.8 20.8L10.99 21.86C11.54 22.04 12.45 22.04 13.01 21.86L16.2 20.8C17.4 20.4 18.38 19.04 18.38 17.77V13.13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M21.4 15V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Пользователи",
    ),
    array(
        "TITLE" => "Пользователи",
        "LINK" => base_url("/admin/users"),
        "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 flex-shrink-0"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Пользователи",
    ),
    array(
        "TITLE" => "Аудитории",
        "LINK" => base_url("/admin/auditories"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open w-5 h-5 flex-shrink-0"><path d="M13 4h3a2 2 0 0 1 2 2v14"></path><path d="M2 20h3"></path><path d="M13 20h9"></path><path d="M10 12v.01"></path><path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
    ),
    array(
        "TITLE" => "Тип аудиторий",
        "LINK" => base_url("/admin/room-types"),
        "ICON" => '<svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M2 2.75A.75.75 0 012.75 2h10a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0V3.5H8.5v9H10a.75.75 0 010 1.5H5.5a.75.75 0 010-1.5H7v-9H3.5v.75a.75.75 0 01-1.5 0v-1.5z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Типы",
    ),
    array(
        "TITLE" => "Тип оборудования",
        "LINK" => base_url("/admin/equipment-types"),
        "ICON" => '<svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M2 2.75A.75.75 0 012.75 2h10a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0V3.5H8.5v9H10a.75.75 0 010 1.5H5.5a.75.75 0 010-1.5H7v-9H3.5v.75a.75.75 0 01-1.5 0v-1.5z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Типы",
    ),
    array(
        "TITLE" => "Оборудование в аудиториях",
        "LINK" => base_url("/admin/room-equipment"),
        "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
    ),
    array(
        "TITLE" => "Здания",
        "LINK" => base_url("/admin/buildings"),
        'ICON' => '<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 11H4.6C4.03995 11 3.75992 11 3.54601 11.109C3.35785 11.2049 3.20487 11.3578 3.10899 11.546C3 11.7599 3 12.0399 3 12.6V21M16.5 11H19.4C19.9601 11 20.2401 11 20.454 11.109C20.6422 11.2049 20.7951 11.3578 20.891 11.546C21 11.7599 21 12.0399 21 12.6V21M16.5 21V6.2C16.5 5.0799 16.5 4.51984 16.282 4.09202C16.0903 3.71569 15.7843 3.40973 15.408 3.21799C14.9802 3 14.4201 3 13.3 3H10.7C9.57989 3 9.01984 3 8.59202 3.21799C8.21569 3.40973 7.90973 3.71569 7.71799 4.09202C7.5 4.51984 7.5 5.0799 7.5 6.2V21M22 21H2M11 7H13M11 11H13M11 15H13" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
    ),
    array(
        "TITLE" => "Импорт/Экспорт",
        "LINK" => base_url("/admin/import-export"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload w-5 h-5 flex-shrink-0"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Инструменты",
    ),
    array(
        "TITLE" => "Журнал действий",
        "LINK" => base_url("/admin/journal"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5 flex-shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Инструменты",
    ),
    array(
        "TITLE" => "Роли и права",
        "LINK" => base_url("/admin/roles"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield w-5 h-5 flex-shrink-0"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Администрирование",
    ),
    array(
        "TITLE" => "Настройки",
        "LINK" => base_url("/admin/settings"),
        'ICON' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings w-5 h-5 flex-shrink-0"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Администрирование",
    )
);

$grouped = [];
foreach ($arLeftMenu as $item) {
    $section = isset($item['SECTION']) && $item['SECTION'] ? $item['SECTION'] : 'Другие';
    $grouped[$section][] = $item;
}

// dump($grouped);
?>

<nav class="nav w-100">
    <ul class="menu d-flex flex-column gap-2">
        <? foreach ($grouped as $key => $items): ?>
            <li class="menu__section pb-2">
                <span class="menu__header d-flex align-items-center justify-content-beetwen">
                    <span class="menu__section-name">
                        <span class="menu__line"></span>
                        <span><?= $key; ?></span>
                    </span>
                    <span class="menu__arrow">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </span>
                <ul class="menu__list d-flex flex-column gap-1 pt-1 <?= strpos($_COOKIE['openMenu'], $key) === false ? 'hide' : '' ?>">
                    <? foreach ($items as $item): ?>
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
            </li>
        <? endforeach; ?>
    </ul>
</nav>