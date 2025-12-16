<?

namespace App\Controllers;

use App\Models\ScheduleTemplateModel;

class ScheduleTemplateController extends BaseController
{

    public function list()
    {
        $model = new ScheduleTemplateModel();
        return view('admin/schedule-templates', ['title' => "Schedule Templates Page", 'groups' => $model->getListGroupsWithSemesters()], 'admin');
    }

    public function schedules($semesterId, $groupId)
    {
        $model = new ScheduleTemplateModel();
        return view('admin/schedule-templates/list-current-group', ['title' => "Schedule Templates Page", 'list' => $model->getCurrentGroupScheduleTemplates($semesterId, $groupId)], 'admin');
    }

    // public function listSemesters($groupId) {}

    public function create() {}

    public function edit() {}

    public function delete() {}
}
