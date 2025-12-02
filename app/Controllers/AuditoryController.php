<?

namespace App\Controllers;

class AuditoryController extends BaseController
{
    public function list()
    {
        return view('admin/auditories', ['title' => "Auditories Page"], 'admin');
    }

    public function create()
    {
        return view('admin/auditories/create', ['title' => "Create Auditories Page"], 'admin');
    }
}
