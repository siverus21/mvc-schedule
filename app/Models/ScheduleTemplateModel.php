<?

namespace App\Models;

use App\Models\SemesterModel;
use App\Models\StudentGroupModel;

class ScheduleTemplateModel extends BaseModel
{
    protected string $table = 'schedule_templates';
    public bool $timestamp = true;

    protected array $loaded = ['student_group_id', 'semester_id', 'subject_id', 'teacher_id', 'room_id', 'lesson_type_id', 'day_of_week', 'week_parity', 'start_time', 'end_time', 'ordinal', 'notes', 'is_active'];
    protected array $fillable = ['student_group_id', 'semester_id', 'subject_id', 'teacher_id', 'room_id', 'lesson_type_id', 'day_of_week', 'week_parity', 'start_time', 'end_time', 'ordinal', 'notes', 'is_active'];

    public array $rules = [
        'required' => ['student_group_id', 'semester_id', 'subject_id', 'teacher_id', 'room_id', 'lesson_type_id', 'day_of_week', 'start_time', 'end_time'],
    ];

    public function getListGroupsWithSemesters()
    {
        $semesters = new SemesterModel();
        $semesters = $semesters->getSemesters();

        $groups = new StudentGroupModel();
        $groups = $groups->getStudentGroups();

        foreach ($groups as $key => $group) {
            foreach ($semesters as $semester) {
                $groups[$key]['semesters'][$semester['id']] = $semester['name'];
            }
        }

        return $groups;
    }

    public function getCurrentGroupScheduleTemplates($semesterId, $groupId, $allDays = false, $is_active = false)
    {
        $query = "        
        SELECT
            st.id AS id,
            st.student_group_id AS group_id,
            st.subject_id AS subject_id,
            st.teacher_id AS teacher_id,
            st.room_id AS room_id,
            st.lesson_type_id AS lesson_type_id,
            st.day_of_week AS day_of_week,
            st.week_parity AS week_parity,
            st.start_time AS start_time,
            st.end_time AS end_time,
            st.ordinal AS ordinal,
            st.notes AS notes,
            st.is_active AS is_active,

            sg.name AS student_group_name,
            sg.notes AS student_group_notes,

            s.id AS semester_name,

            sub.name AS subject_name,

            t.user_id AS teacher_user_id,

            u.display_name AS teacher_name,

            r.name AS room_name,

            lt.code AS lesson_type_code,
            lt.name AS lesson_type_name

            FROM schedule_templates AS st
            LEFT JOIN student_groups AS sg ON sg.id = st.student_group_id
            LEFT JOIN semesters AS s ON s.id = st.semester_id
            LEFT JOIN subjects AS sub ON sub.id = st.subject_id
            LEFT JOIN teachers AS t ON t.id = st.teacher_id
            LEFT JOIN users AS u ON u.id = t.user_id
            LEFT JOIN rooms AS r ON r.id = st.room_id
            LEFT JOIN lesson_types AS lt ON lt.id = st.lesson_type_id
            
            WHERE st.semester_id = $semesterId AND st.student_group_id = $groupId";

        if ($is_active) {
            $query .= " AND st.is_active = 1";
        }

        $query .= " ORDER BY st.start_time ASC";

        $data = db()->query($query)->get();

        $result = [];

        $dayOfWeek = getDays();

        foreach ($data as $item) {
            $result["group_name"] = $item['student_group_name'];
            $result["group_notes"] = $item['student_group_notes'];
            $result["semester_name"] = $item['semester_name'];

            unset($item['student_group_name']);
            unset($item['student_group_notes']);
            unset($item['semester_name']);

            $result["days"][$dayOfWeek[$item['day_of_week']]][$item['week_parity']][] = $item;
        }

        if (isset($result["days"])) {
            foreach ($result["days"] as $day => $v) {
                ksort($result["days"][$day]);
            }

            $sortedDays = [];
            foreach ($dayOfWeek as $dayName) {
                if ($allDays) {
                    $sortedDays[$dayName] = isset($result['days'][$dayName]) ? $result['days'][$dayName] : [];
                } else {
                    if (isset($result['days'][$dayName])) $sortedDays[$dayName] = $result['days'][$dayName];
                }
            }
            $result['days'] = $sortedDays;
        }

        return $result;
    }

    public function getAllScheduleTemplates()
    {
        return db()->query("SELECT * FROM $this->table")->getAssoc();
    }

    public function getScheduleTemplate(int|string $id): array
    {
        return $this->getRecordById($id);
    }

    public function countScheduleTemplates()
    {
        return db()->count($this->table);
    }

    /**
     * Проверка пересечения по времени: в тот же день и неделю (чётная/нечётная)
     * уже есть занятие у этой группы или у этого преподавателя.
     * Возвращает массив строк-предупреждений (пустой, если конфликтов нет).
     *
     * @param int|string $semesterId
     * @param int|string $studentGroupId
     * @param int|string $teacherId
     * @param int $dayOfWeek
     * @param int $weekParity
     * @param string $startTime время 'H:i' или 'H:i:s'
     * @param string $endTime
     * @param int|string|null $excludeId id записи, которую не учитывать (при редактировании)
     * @return array<string>
     */
    public function findTimeConflicts($semesterId, $studentGroupId, $teacherId, $dayOfWeek, $weekParity, $startTime, $endTime, $excludeId = null): array
    {
        $warnings = [];
        $startTime = date('H:i:s', strtotime($startTime));
        $endTime = date('H:i:s', strtotime($endTime));

        $excludeCond = $excludeId !== null && $excludeId !== ''
            ? ' AND st.id != :exclude_id'
            : '';
        $params = [
            'semester_id'    => $semesterId,
            'day_of_week'    => $dayOfWeek,
            'week_parity'    => $weekParity,
            'start_time'     => $endTime,
            'end_time'       => $startTime,
        ];
        if ($excludeCond) {
            $params['exclude_id'] = $excludeId;
        }

        // Конфликт по группе: в это время у группы уже есть занятие
        $sqlGroup = "SELECT st.id, st.start_time, st.end_time, sub.name AS subject_name
            FROM {$this->table} AS st
            LEFT JOIN subjects AS sub ON sub.id = st.subject_id
            WHERE st.semester_id = :semester_id AND st.student_group_id = :student_group_id
            AND st.day_of_week = :day_of_week AND st.week_parity = :week_parity
            AND st.start_time < :start_time AND st.end_time > :end_time
            {$excludeCond}";
        $paramsGroup = $params + ['student_group_id' => $studentGroupId];
        $groupConflicts = db()->query($sqlGroup, $paramsGroup)->get();
        if (!empty($groupConflicts)) {
            $subjects = array_map(fn($r) => $r['subject_name'] . ' (' . $r['start_time'] . '–' . $r['end_time'] . ')', $groupConflicts);
            $warnings[] = 'В это время у группы уже запланировано занятие: ' . implode(', ', $subjects);
        }

        // Конфликт по преподавателю: в это время у преподавателя уже есть занятие
        $sqlTeacher = "SELECT st.id, st.start_time, st.end_time, sub.name AS subject_name, sg.name AS group_name
            FROM {$this->table} AS st
            LEFT JOIN subjects AS sub ON sub.id = st.subject_id
            LEFT JOIN student_groups AS sg ON sg.id = st.student_group_id
            WHERE st.semester_id = :semester_id AND st.teacher_id = :teacher_id
            AND st.day_of_week = :day_of_week AND st.week_parity = :week_parity
            AND st.start_time < :start_time AND st.end_time > :end_time
            {$excludeCond}";
        $paramsTeacher = $params + ['teacher_id' => $teacherId];
        $teacherConflicts = db()->query($sqlTeacher, $paramsTeacher)->get();
        if (!empty($teacherConflicts)) {
            $items = array_map(fn($r) => $r['subject_name'] . ' — ' . $r['group_name'] . ' (' . $r['start_time'] . '–' . $r['end_time'] . ')', $teacherConflicts);
            $warnings[] = 'В это время у преподавателя уже есть занятие: ' . implode('; ', $items);
        }

        return $warnings;
    }

    /**
     * Установить предупреждения о пересечении по времени (для вывода на форму).
     */
    public function setTimeConflictWarnings(array $warnings): void
    {
        $this->errors['time_conflict'] = $warnings;
    }
}
