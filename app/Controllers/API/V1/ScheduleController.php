<?php

namespace App\Controllers\API\V1;

use App\Models\ScheduleTemplateModel;

class ScheduleController
{
    private const DEFAULT_SEMESTER_ID = '1';
    private const CACHE_KEY_PREFIX = 'api:schedule:';
    private const CACHE_TTL = 300; // 5 минут

    /**
     * POST /api/v1/schedule — расписание по группе и/или преподавателю.
     * Варианты: group (обязательна для режима «по группе»), teacher (опционально — фильтр по группе или «только преподаватель»).
     * Если указан только teacher — возвращается расписание преподавателя по всем группам.
     */
    public function index(): void
    {
        $params = $this->getValidatedRequestParams();
        if ($params === null) {
            $this->jsonError('No data provided', 400);
            return;
        }

        $groupId = isset($params['group']) && $params['group'] !== '' && $params['group'] !== null
            ? (string) trim($params['group'])
            : null;

        $teacherRaw = $params['teacher'] ?? null;
        if (is_array($teacherRaw)) {
            $teacherRaw = $teacherRaw[0] ?? null;
        }
        if ($teacherRaw === null || $teacherRaw === '') {
            $teacherRaw = request()->get('teacher');
        }
        $teacherId = $teacherRaw !== null && $teacherRaw !== ''
            ? (string) $teacherRaw
            : null;

        if ($groupId === null && $teacherId === null) {
            $this->jsonError($this->renderAlertMessage('Укажите группу или преподавателя.'), 400);
            return;
        }

        $scheduleHtml = null;

        if ($groupId !== null) {
            // Режим «по группе» (опционально с фильтром по преподавателю)
            $cacheKey = $this->cacheKey(self::DEFAULT_SEMESTER_ID, $groupId, $teacherId);
            if ($teacherId === null || $teacherId === '') {
                $scheduleHtml = cache()->get($cacheKey);
            }
            if ($scheduleHtml === null) {
                $scheduleHtml = $this->getScheduleHtml(self::DEFAULT_SEMESTER_ID, $groupId, $teacherId);
                if ($scheduleHtml === null) {
                    $this->jsonError(
                        $this->renderAlertMessage('Расписание не найдено для указанной группы.'),
                        200
                    );
                    return;
                }
                if ($teacherId === null || $teacherId === '') {
                    cache()->set($cacheKey, $scheduleHtml, self::CACHE_TTL);
                }
            }
        } else {
            // Режим «только преподаватель» — все занятия преподавателя по всем группам
            $cacheKey = self::CACHE_KEY_PREFIX . self::DEFAULT_SEMESTER_ID . ':teacher:' . $teacherId;
            $scheduleHtml = cache()->get($cacheKey);
            if ($scheduleHtml === null) {
                $scheduleHtml = $this->getScheduleHtmlByTeacher(self::DEFAULT_SEMESTER_ID, $teacherId);
                if ($scheduleHtml === null) {
                    $this->jsonError(
                        $this->renderAlertMessage('Расписание не найдено для выбранного преподавателя.'),
                        200
                    );
                    return;
                }
                cache()->set($cacheKey, $scheduleHtml, self::CACHE_TTL);
            }
        }

        response()->json([
            'status' => 'ok',
            'message' => $scheduleHtml,
        ]);
    }

    private function cacheKey(string $semesterId, string $groupId, ?string $teacherId = null): string
    {
        $key = self::CACHE_KEY_PREFIX . $semesterId . ':' . $groupId;
        if ($teacherId !== null && $teacherId !== '') {
            $key .= ':' . $teacherId;
        }
        return $key;
    }

    /**
     * Параметры запроса: GET и POST объединены (POST перезаписывает GET).
     * Так параметры доходят и из тела POST, и из query string.
     */
    private function getValidatedRequestParams(): ?array
    {
        $data = request()->getMergedParams();
        if (empty($data) || !is_array($data)) {
            return null;
        }
        $result = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $value;
                continue;
            }
            $result[$key] = is_string($value) ? h(trim($value)) : $value;
        }
        return $result;
    }

    /**
     * HTML расписания для группы или null, если расписание пусто.
     * Если передан $teacherId — возвращаются только занятия этого преподавателя.
     */
    private function getScheduleHtml(string $semesterId, string $groupId, ?string $teacherId = null): ?string
    {
        $model = new ScheduleTemplateModel();
        $list = $model->getCurrentGroupScheduleTemplates(
            (int) $semesterId,
            (int) $groupId,
            true,
            true
        );

        if (empty($list['days'] ?? null)) {
            return null;
        }

        if ($teacherId !== null && $teacherId !== '') {
            $list['days'] = $this->filterDaysByTeacher($list['days'], (int) $teacherId);
            if (empty($list['days'])) {
                return null;
            }
        }

        $list['days'] = $this->sortLessonsByTime($list['days']);

        return view()->renderPartial('incs/schedule', [
            'data' => [
                'list' => $list,
                'weekParity' => getWeekParity(),
            ],
        ]);
    }

    /**
     * HTML расписания по преподавателю (все группы). У занятий в списке есть student_group_name.
     */
    private function getScheduleHtmlByTeacher(string $semesterId, string $teacherId): ?string
    {
        $model = new ScheduleTemplateModel();
        $list = $model->getScheduleByTeacher((int) $semesterId, (int) $teacherId, true, true);

        if (empty($list['days'] ?? null)) {
            return null;
        }

        $list['days'] = $this->sortLessonsByTime($list['days']);

        return view()->renderPartial('incs/schedule', [
            'data' => [
                'list' => $list,
                'weekParity' => getWeekParity(),
            ],
        ]);
    }

    /**
     * Оставляет в каждом дне только занятия с указанным teacher_id.
     * Сохраняет структуру: день => [ чётность_недели => [ уроки ] ].
     */
    private function filterDaysByTeacher(array $days, int $teacherId): array
    {
        $result = [];
        foreach ($days as $dayName => $dayData) {
            if (!is_array($dayData)) {
                continue;
            }
            $result[$dayName] = [];
            foreach ($dayData as $parity => $lessons) {
                if (!is_array($lessons)) {
                    continue;
                }
                $filtered = [];
                foreach ($lessons as $lesson) {
                    if (isset($lesson['teacher_id']) && (int) $lesson['teacher_id'] === $teacherId) {
                        $filtered[] = $lesson;
                    }
                }
                if (!empty($filtered)) {
                    $result[$dayName][$parity] = $filtered;
                }
            }
        }
        return $result;
    }

    /**
     * Для каждого дня собирает все занятия (по чётности недели) в один массив и сортирует по времени.
     */
    private function sortLessonsByTime(array $days): array
    {
        foreach ($days as $day => $weekParity) {
            if (empty($weekParity) || !is_array($weekParity)) {
                continue;
            }
            $lessons = [];
            foreach ($weekParity as $parityLessons) {
                if (is_array($parityLessons)) {
                    foreach ($parityLessons as $les) {
                        $lessons[] = $les;
                    }
                }
            }
            uasort($lessons, fn($a, $b) => strcmp($a['start_time'] ?? '', $b['start_time'] ?? ''));
            $days[$day] = $lessons;
        }
        return $days;
    }

    private function renderAlertMessage(string $text): string
    {
        return view()->renderPartial('incs/alert_info', [
            'flash_info' => $text,
        ]);
    }

    private function jsonError(string $message, int $httpCode = 400): void
    {
        response()->json([
            'status' => 'error',
            'message' => $message,
        ], $httpCode);
    }
}
