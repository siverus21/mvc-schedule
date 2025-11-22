<?

namespace App\Controllers;

class HomeController extends BaseController
{

    public function index(): string
    {
        return view('home', ['title' => "Home Page"], 'default');
    }

    public function dashboard(): string
    {
        return view('dashboard', ['title' => "Dashboard Page"], 'default');
    }

    public function test()
    {
        return view('test', ['name' => 'John2', 'age' => 30]);
    }
}
