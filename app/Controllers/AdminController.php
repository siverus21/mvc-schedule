<?

namespace App\Controllers;

class AdminController extends BaseController
{

    public function index()
    {
        response()->redirect('/admin/dashboard');
    }

    public function dashboard()
    {
        return view('admin/dashboard', ['title' => "Dashboard Page"], 'admin');
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

    public function teachers()
    {
        return view('admin/teachers', ['title' => "teachers Page"], 'admin');
    }
}
