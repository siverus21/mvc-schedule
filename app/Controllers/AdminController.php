<?

namespace App\Controllers;

use App\Wigets\AuditoryWiget;
use App\Wigets\TeacherWiget;
use App\Wigets\ScheduleWiget;

class AdminController extends BaseController
{

    public function index()
    {
        response()->redirect('/admin/dashboard');
    }

    public function dashboard()
    {
        $wigets = [
            'schedule' => ScheduleWiget::renderHTML(),
            'auditories' => AuditoryWiget::renderHTML(),
            'teachers' => TeacherWiget::renderHTML(),
        ];
        return view('admin/dashboard', ['title' => "Dashboard Page", 'wigets' => $wigets], 'admin');
    }

    public function importExport()
    {
        return view('admin/import-export', ['title' => "importExport Page"], 'admin');
    }

    public function journal()
    {
        return view('admin/journal', ['title' => "journal Page"], 'admin');
    }

    public function roles()
    {
        return view('admin/roles', ['title' => "roles Page"], 'admin');
    }

    public function schedule()
    {
        return view('admin/schedule', ['title' => "schedule Page"], 'admin');
    }

    public function settings()
    {
        return view('admin/settings', ['title' => "settings Page"], 'admin');
    }
}
