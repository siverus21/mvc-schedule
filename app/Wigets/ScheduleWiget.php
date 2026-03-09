<?

namespace App\Wigets;

use App\Models\ScheduleTemplateModel;

class ScheduleWiget extends BaseWiget
{
    public static string $name = "Занятий";
    public static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-6 h-6"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>';
    public static string $color_icon = "icon_purple";

    public static function renderHTML(): string
    {
        $count = (new ScheduleTemplateModel())->countScheduleTemplates();
        return static::renderDefaultBlock($count);
    }
}
