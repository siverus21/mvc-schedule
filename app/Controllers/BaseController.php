<?

namespace App\Controllers;

use Youpi\Controller;


class BaseController extends Controller
{

    public function __construct()
    {
        app()->set('test', 'Test value');

        if (!$menu = cache()->get('menu')) {
            cache()->set('menu', $this->renderMenu(), 20);
        }
    }

    public function renderMenu(): string
    {
        return view()->renderPartial('incs/menu');
    }
}
