<?

namespace App\Filters;


use App\Filters\BaseFilter;
use App\Models\StudentGroupModel;


class GroupFilter extends BaseFilter
{
    public static function renderHTML()
    {
        $studentGroupModel = new StudentGroupModel();
        $groups = $studentGroupModel->getStudentGroups();

        return view()->renderPartial('incs/filters/group', ['groups' => $groups]);
    }
}
