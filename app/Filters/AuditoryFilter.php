<?

namespace App\Filters;


use App\Filters\BaseFilter;
use App\Models\AuditoryModel;


class AuditoryFilter extends BaseFilter
{
    public static function renderHTML()
    {
        $auditoryModel = new AuditoryModel();
        $auditories = $auditoryModel->getAuditoriesWithBuilding();

        return view()->renderPartial('incs/filters/auditory', ['auditories' => $auditories]);
    }
}
