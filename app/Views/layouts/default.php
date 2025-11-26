<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youpi :: <?= $title ?? "" ?></title>
    <?= getCsrfMeta(); ?>

    <link rel="stylesheet" href="<?= base_url('/public/assets/css/iziModal.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/color-scheme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>">
    <? if (!empty($styles)): ?>
        <? foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= $style; ?>">
        <? endforeach; ?>
    <? endif; ?>

    <? if (!empty($headerScripts)): ?>
        <? foreach ($headerScripts as $headerScript): ?>
            <script src="<?= $headerScript; ?>"></script>
        <? endforeach; ?>
    <? endif; ?>

</head>

<body>
    <header class="header">
        <div class="header__left">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap w-7 h-7" aria-hidden="true" style="color: rgb(255, 255, 255);">
                <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                <path d="M22 10v6"></path>
                <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
            </svg>
            <div>
                <h1>UniSchedule</h1>
                <p>Электронное расписание</p>
            </div>
        </div>
        <div class="header__rigth">
            <button class="change-color-theme js-change-color-theme">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon w-5 h-5" aria-hidden="true" style="color: rgb(99, 102, 241);">
                        <path d="M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401"></path>
                    </svg>
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun w-5 h-5" aria-hidden="true" style="color: rgb(251, 191, 36);">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </svg>
                </span>
            </button>
        </div>
    </header>

    <main>
        <div class="filters">
            <div class="filters__header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-funnel w-5 h-5" aria-hidden="true" style="color: rgb(99, 102, 241);">
                    <path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"></path>
                </svg>
                <h3>Фильтры</h3>
            </div>
            <div class="filters__body">
                <form class="filter__form" method="post">
                    <div class="filter__item">
                        <label for="group">Группа</label>
                        <select name="group" id="group">
                            <option value="ИВТ-101">ИВТ-101</option>
                            <option value="ИВТ-102">ИВТ-102</option>
                            <option value="ИВТ-103">ИВТ-103</option>
                            <option value="ИВТ-104">ИВТ-104</option>
                        </select>
                    </div>
                    <div class="filter__item">
                        <label for="teacher">Преподаватель</label>
                        <select name="teacher" id="teacher">
                            <option value="Иванов">Иванов</option>
                            <option value="Петров">Петров</option>
                            <option value="Сидоров">Сидоров</option>
                            <option value="Смирнов">Смирнов</option>
                        </select>
                    </div>
                    <div class="filter__item">
                        <label for="classroom">Аудитория</label>
                        <select name="classroom" id="classroom">
                            <option value="101">101</option>
                            <option value="102">102</option>
                            <option value="103">103</option>
                            <option value="104">104</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="schedule">
            <div class="schedule__select">
                <div>
                    <button class="button js-schedule-select-week">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-grid w-4 h-4" aria-hidden="true">
                            <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                            <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                            <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                            <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                        </svg>
                        <span>Неделя</span>
                    </button>
                    <button class="button js-schedule-select-day">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4" aria-hidden="true">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span>День</ы>
                    </button>
                </div>

            </div>
            <div class="schedule__content">
                <div class="schedule__week js-schedule-week">

                </div>
                <div class="schedule__day js-schedule-day">

                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2025 UniSchedule • Современное расписание для студентов и преподавателей</p>
    </footer>



    <script src="<?= base_url('/public/assets/js/jqeury.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/iziModal.min.js') ?>"></script>

    <? if (!empty($footerScripts)): ?>
        <? foreach ($footerScripts as $footerScript): ?>
            <script src="<?= $footerScript; ?>"></script>
        <? endforeach; ?>
    <? endif; ?>

    <script src="<?= base_url('/public/assets/js/app.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/change-theme.js') ?>"></script>

    <div class="iziModal-alert-success"></div>
    <div class="iziModal-alert-error"></div>

</body>

</html>