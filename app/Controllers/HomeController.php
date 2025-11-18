<?

namespace App\Controllers;

class HomeController
{

    public function index(): string
    {
        return 'is index';
    }

    public function test()
    {
        return view('test', ['name' => 'John2', 'age' => 30]);
    }
}
