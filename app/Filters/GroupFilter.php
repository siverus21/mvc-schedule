<?

namespace App\Filters;
use App\Models\StudentGroupModel;


class GroupFilter extends BaseFilter
{

    public static string $id = 'group';
    public static string $name = 'group';
    public static string $title = 'Группа';
    public static string $disableItemText = 'Выберите группу';

    public static function renderHTML()
    {
        $studentGroupModel = new StudentGroupModel();
        $groups = $studentGroupModel->getStudentGroups();
        return static::renderDefaultSelect($groups);
    }
}
