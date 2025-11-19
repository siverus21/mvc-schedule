<?

namespace App\Controllers;

use App\Models\UserModel;
use Valitron\Validator;

class UserController extends BaseController
{

    public function register()
    {
        return view('user/register', ['title' => "Register Page"]);
    }

    public function store()
    {
        Validator::langDir(LANG_VALIDATOR);
        Validator::lang('ru');

        $model = new UserModel();
        $model->loadData();

        dump($model->attributes);
        dump($model->validate());
        dump($model->getErrors());

        dd($_POST);
    }

    public function login()
    {
        return view('user/login', ['title' => "Login Page"]);
    }
}
