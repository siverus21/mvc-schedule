<?

namespace App\Filters;


use App\Filters\BaseFilter;
use App\Models\TeacherModel;


class TeacherFilter extends BaseFilter
{

    public static string $id = 'teacher';
    public static string $name = 'teacher';
    public static string $title = 'Преподаватель';
    public static string $disableItemText = 'Выберите преподавателя';

    public static function renderHTML()
    {
        $teacherModel = new TeacherModel();
        $teachers = $teacherModel->getAllTeachers();

        foreach ($teachers as $key => $teacher) {
            $teachers[$key]['notes'] = $teacher['academic_degree'] ? $teacher['academic_degree'] : '';
            unset($teachers[$key]['academic_degree']);
        }

        return view()->renderPartial('incs/filters/defaultSelectFilter', ['items' => $teachers, 'disableItemText' => self::$disableItemText, 'id' => self::$id, 'name' => self::$name, 'title' => self::$title]);
    }
}
