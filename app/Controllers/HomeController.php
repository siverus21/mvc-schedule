<?

namespace App\Controllers;

class HomeController extends BaseController
{

    public function index(): string
    {
        return view('home', ['title' => "Home Page"], 'default');
    }
}
