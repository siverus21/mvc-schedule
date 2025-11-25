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
        for ($i = 0; $i < count(request()->files['files']['name']); $i++) {
            $file = new File('files[' . $i . ']');
            dump($file->save());
        }
        $file1 = new File('file');
        // $file->save();
        // return 'Test';
    }
}
