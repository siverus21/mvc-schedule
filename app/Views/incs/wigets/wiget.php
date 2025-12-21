<?
// $arWiget = array(
//     0 => array(
//         "TITLE" => "Всего пар",
//         "ICON" => 
//         "COUNT" => 156,
//     ),
//     1 => array(
//         "TITLE" => "Преподавателей",
//         "ICON" => ,
//         "COUNT" => 45,
//     ),
//     2 => array(
//         "TITLE" => "Аудиторий",
//         "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open w-6 h-6"><path d="M13 4h3a2 2 0 0 1 2 2v14"></path><path d="M2 20h3"></path><path d="M13 20h9"></path><path d="M10 12v.01"></path><path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"></path></svg>',
//         "COUNT" => $data["countAuditories"],
//         "COLOR_ICON" => "icon_blue",
//     ),
//     3 => array(
//         "TITLE" => "Конфликтов",
//         "ICON" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert w-6 h-6"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>',
//         "COUNT" => 3,
//         "COLOR_ICON" => "icon_warning",
//     ),
// );
?>
<? dd($data) ?>
<div class="wiget d-grid grid-col-4 gap-2 w-100">
    <? foreach ($arWiget as $wiget): ?>
        <div class="wiget__item default-block">
            <div class="wiget__header">
                <i class="icon <?= $wiget['COLOR_ICON'] ?? "icon_purple" ?>">
                    <?= $wiget['ICON'] ?>
                </i>
            </div>
            <p class="wiget__number"><?= $wiget['COUNT'] ?></p>
            <p class="wiget__name"><?= $wiget['TITLE'] ?></p>
        </div>
    <? endforeach; ?>
</div>