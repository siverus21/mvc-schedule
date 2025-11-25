<?

namespace App\Controllers;

use Youpi\Controller;


class BaseController extends Controller
{

    public function __construct()
    {
        if (!$menu = cacheRedis()->get('menu')) {
            cacheRedis()->set('menu', $this->renderMenu());
        }
    }

    public function renderMenu(): string
    {
        return view()->renderPartial('incs/menu');
    }
}
