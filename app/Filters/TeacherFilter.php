<?

namespace App\Filters;


use App\Filters\BaseFilter;
use App\Models\TeacherModel;


class TeacherFilter extends BaseFilter
{
    public static function renderHTML()
    {
        $teacherModel = new TeacherModel();
        $teachers = $teacherModel->getAllTeachers();

        return view()->renderPartial('incs/filters/teacher', ['teachers' => $teachers]);
    }
}
