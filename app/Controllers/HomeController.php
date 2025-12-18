<?

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Filters\GroupFilter;
use App\Filters\TeacherFilter;
use App\Filters\AuditoryFilter;

class HomeController extends BaseController
{

    public function index(): string
    {
        $filters = [
            "groupFilter" => GroupFilter::renderHTML(),
            "teacherFilter" => TeacherFilter::renderHTML(),
            "auditoryFilter" => AuditoryFilter::renderHTML(),
        ];
        return view('home', ['title' => "Home Page", 'filters' => $filters], 'default');
    }
}
