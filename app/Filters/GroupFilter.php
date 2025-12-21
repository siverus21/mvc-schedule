<?

namespace App\Filters;


use App\Filters\BaseFilter;
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
        return view()->renderPartial('incs/filters/defaultSelectFilter', ['items' => $groups, 'disableItemText' => self::$disableItemText, 'id' => self::$id, 'name' => self::$name, 'title' => self::$title]);
    }
}
