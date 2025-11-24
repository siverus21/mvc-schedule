<?

namespace App\Controllers;

use Youpi\File;

class TestController extends BaseController
{
    public function index()
    {
        return view('test/index', [
            'title' => "Test Page"
        ]);
    }

    public function send()
    {
        $file = new File('file');
        $file->save();
        // return 'Test';
    }
}
