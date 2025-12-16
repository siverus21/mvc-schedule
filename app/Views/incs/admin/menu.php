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
        "TITLE" => "Дисциплины",
        "LINK" => base_url("/admin/subjects"),
        "ICON" => '<svg fill="currentColor" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"><path d="M3,8h18c0.6,0,1-0.4,1-1s-0.4-1-1-1H3C2.4,6,2,6.4,2,7S2.4,8,3,8z M13,16H3c-0.6,0-1,0.4-1,1s0.4,1,1,1h10c0.6,0,1-0.4,1-1S13.6,16,13,16z M21,11H3c-0.6,0-1,0.4-1,1s0.4,1,1,1h18c0.6,0,1-0.4,1-1S21.6,11,21,11z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
    ),
    array(
        "TITLE" => "Учебные группы",
        "LINK" => base_url("/admin/student-groups"),
        "ICON" => ' <svg fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 29.127 29.128" xml:space="preserve">
                        <path d="M22.471,15.103c0,1.021,0.824,1.847,1.849,1.847c1.021,0,1.845-0.826,1.845-1.847c0-1.021-0.824-1.847-1.845-1.847 C23.295,13.254,22.471,14.081,22.471,15.103z"></path>
                        <path d="M21.66,20.878c0,1.465,1.19,2.657,2.659,2.657c1.463,0,2.654-1.192,2.654-2.657c0-1.468-1.191-2.659-2.654-2.659 C22.85,18.219,21.66,19.41,21.66,20.878z"></path>
                        <polygon points="27.485,24.576 25.344,23.932 24.364,25.107 23.352,23.932 21.004,24.576 21.004,29.056 27.633,29.056 "></polygon>
                        <path d="M14.808,18.293c-1.467,0-2.659,1.191-2.659,2.658c0,1.465,1.192,2.657,2.659,2.657c1.466,0,2.656-1.192,2.656-2.657 C17.463,19.485,16.272,18.293,14.808,18.293z"></path>
                        <polygon points="15.835,24.006 14.852,25.183 13.842,24.006 11.494,24.65 11.494,29.128 18.124,29.128 17.975,24.65 "></polygon>
                        <circle cx="19.487" cy="17.242" r="1.944"></circle>
                        <path d="M21.91,23.107c-0.347-0.654-0.588-1.364-0.588-2.156c0-0.521,0.141-1.005,0.298-1.474H21.43h-0.473h-0.723l-0.717,0.86 l-0.739-0.86h-0.761h-0.424c0.196,0.455,0.31,0.952,0.31,1.472c0,0.855-0.3,1.638-0.794,2.278h4.803L21.91,23.107z"></path>
                        <circle cx="6.152" cy="10.675" r="3.732"></circle>
                        <polygon points="14.664,12.543 9.908,14.967 7.51,14.967 6.089,16.617 4.711,14.967 1.703,15.612 1.495,22.236 2.775,22.236 2.826,23.264 9.576,23.264 9.903,16.904 15.242,14.289 "></polygon>
                        <path d="M13.141,8.3l-1.498,2.234l0.581-0.046c0.04-0.004,3.914-0.328,6.596-0.923c3.521-0.778,5.616-2.336,5.755-4.273 c0.186-2.635-2.781-4.998-6.612-5.267c-3.83-0.27-7.097,1.654-7.282,4.289C10.575,5.807,11.49,7.281,13.141,8.3z M17.924,0.586 c3.521,0.248,6.254,2.341,6.088,4.667c-0.166,2.373-3.771,3.423-5.312,3.764c-2.027,0.449-4.753,0.743-5.935,0.857l1.178-1.76 L13.68,7.965c-1.622-0.913-2.534-2.265-2.44-3.612C11.406,2.028,14.402,0.339,17.924,0.586z"></path>
                    </svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
    ),
    array(
        "TITLE" => "Семестры",
        "LINK" => base_url("/admin/semesters"),
        "ICON" => '<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10H17M7 14H12M7 3V5M17 3V5M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Управление",
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
        "TITLE" => "Тип академической степени",
        "LINK" => base_url("/admin/academic-degrees"),
        "ICON" => '<svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M2 2.75A.75.75 0 012.75 2h10a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0V3.5H8.5v9H10a.75.75 0 010 1.5H5.5a.75.75 0 010-1.5H7v-9H3.5v.75a.75.75 0 01-1.5 0v-1.5z"></path></svg>',
        "ACTIVE" => true,
        "ACCESS" => true,
        "SECTION" => "Типы",
    ),
    array(
        "TITLE" => "Тип занятия",
        "LINK" => base_url("/admin/lesson-types"),
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
        "TITLE" => "Кафедры",
        "LINK" => base_url("/admin/department"),
        'ICON' => '<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z" fill="currentColor"> </path></svg>',
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