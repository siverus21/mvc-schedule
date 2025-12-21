<?

namespace App\Models;

use Youpi\Model;
use App\Models\SemesterModel;
use App\Models\StudentGroupModel;

class ScheduleTemplateModel extends Model
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

    public function getCurrentGroupScheduleTemplates($semesterId, $groupId, $allDays = false)
    {
        $data = db()->query("
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

            WHERE st.semester_id = $semesterId AND st.student_group_id = $groupId
            ORDER BY st.start_time ASC
        ")->get();

        $result = [];

        $dayOfWeek = getDays();

        foreach ($data as $item) {
            $result["group_name"] = $item['student_group_name'];
            $result["group_notes"] = $item['student_group_notes'];
            $result["semester_name"] = $item['semester_name'];

            unset($item['student_group_name']);
            unset($item['student_group_notes']);
            unset($item['semester_name']);

            $result["days"][$dayOfWeek[$item['day_of_week']]]["schedules"][] = $item;
        }

        if (isset($result["days"])) {
            $sortedDays = [];
            foreach ($dayOfWeek as $dayName) {
                if ($allDays) {
                    $sortedDays[$dayName] = isset($result['days'][$dayName]) ? $result['days'][$dayName] : ['schedules' => []];
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

    public function getScheduleTemplate($id)
    {
        return db()->findOrFail($this->table, $id);
    }

    public function countScheduleTemplates()
    {
        return db()->count($this->table);
    }
}
