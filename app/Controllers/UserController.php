<?

namespace App\Controllers;

use App\Models\UserModel;
use Valitron\Validator;
use Youpi\Pagination;

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
        $model = new UserModel();
        $model->loadData();

        // Сообщения для алертов тянутся из названия файлов.
        if (!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {

            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);

            if ($id = $model->save()) {
                session()->setFlash('success', 'Thanks for registration, your id is ' . $id);
            } else {
                session()->setFlash('error', 'Error registration');
            }
        }

        response()->redirect('/register');
    }

    public function login()
    {
        return view('user/login', ['title' => "Login Page"]);
    }

    public function index()
    {
        $usersCount = db()->count('users');
        $pagination = new Pagination($usersCount, 1, 2);

        $users = db()->query("select * from users limit {$pagination->getLimit()} offset {$pagination->getOffset()}")->get();

        return view('user/index', [
            'title' => "Index Page",
            'users' => $users,
            'pagination' => $pagination
        ]);
    }
}
