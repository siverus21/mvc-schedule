<?

namespace App\Wigets;

use App\Wigets\BaseWiget;
use App\Models\AuditoryModel;

class AuditoryWiget extends BaseWiget
{

    public static string $name = "Аудиторий";
    public static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open w-6 h-6"><path d="M13 4h3a2 2 0 0 1 2 2v14"></path><path d="M2 20h3"></path><path d="M13 20h9"></path><path d="M10 12v.01"></path><path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"></path></svg>';
    public static string $color_icon = "icon_blue";

    public static function renderHTML()
    {

        $model = new AuditoryModel();
        $countAuditories = $model->countAuditories();

        return view()->renderPartial('incs/wigets/defaultBlock', ['count' => $countAuditories, 'name' => self::$name, 'icon' => self::$icon, 'color_icon' => self::$color_icon]);
    }
}
