<?

namespace App\Filters;


use App\Filters\BaseFilter;
use App\Models\AuditoryModel;


class AuditoryFilter extends BaseFilter
{

    public static string $id = 'classroom';
    public static string $name = 'classroom';
    public static string $title = 'Аудитория';
    public static string $disableItemText = 'Выберите аудиторию';

    public static function renderHTML()
    {
        $auditoryModel = new AuditoryModel();
        $auditories = $auditoryModel->getAuditoriesWithBuilding();

        foreach ($auditories as $key => $auditory) {
            $auditories[$key]['notes'] = $auditory['building_name'] ? $auditory['building_name'] : '';
            unset($auditories[$key]['building_name']);
        }

        return view()->renderPartial('incs/filters/defaultSelectFilter', ['items' => $auditories, 'disableItemText' => self::$disableItemText, 'id' => self::$id, 'name' => self::$name, 'title' => self::$title]);
    }
}
