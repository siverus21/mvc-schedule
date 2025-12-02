<?

namespace App\Controllers;

use Youpi\Controller;

class BuildingController extends Controller
{
    public function list()
    {
        return view('admin/buildings', ['title' => "Buildings Page"], 'admin');
    }

    public function create()
    {
        return view('admin/buildings/create', ['title' => "Create Buildings Page"], 'admin');
    }
}
