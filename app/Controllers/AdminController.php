<?

namespace App\Controllers;

class AdminController extends BaseController
{

    public function dashboard()
    {
        return view('admin/dashboard', ['title' => "Dashboard Page"], 'admin');
    }
}
