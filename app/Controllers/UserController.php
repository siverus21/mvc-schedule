<?

namespace App\Controllers;

use App\Models\UserModel;
use Valitron\Validator;

class UserController extends BaseController
{

    public function register()
    {
        return view('user/register', [
            'title' => "Register Page"
        ]);
    }

    public function store()
    {
        Validator::langDir(LANG_VALIDATOR);
        Validator::lang('ru');

        $model = new UserModel();
        $model->loadData();

        // Сообщения для алертов тянутся из названия файлов.
        if (!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            // UserModel::query()->create([
            //     'name' => $model->name,
            //     'email' => $model->email,
            //     'password' => password_hash($model->password, PASSWORD_DEFAULT)
            // ]);
            if ($model->save()) {
                session()->setFlash('success', 'Thanks for registration');
            } else {
                session()->setFlash('error', 'Error registration');
            }
        }

        response()->redirect('/register');

        // dd($_POST);
    }

    public function login()
    {
        return view('user/login', ['title' => "Login Page"]);
    }
}
