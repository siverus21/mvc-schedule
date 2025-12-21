<?

namespace App\Wigets;

use App\Wigets\BaseWiget;
use App\Models\TeacherModel;

class TeacherWiget extends BaseWiget
{

    public static string $name = "Преподавателей";
    public static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
    public static string $color_icon = "icon_purple";

    public static function renderHTML()
    {

        $model = new TeacherModel();
        $countTeachers = $model->countTeachers();

        return view()->renderPartial('incs/wigets/defaultBlock', ['count' => $countTeachers, 'name' => self::$name, 'icon' => self::$icon, 'color_icon' => self::$color_icon]);
    }
}
