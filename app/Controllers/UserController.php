<?

namespace App\Controllers;

use App\Models\UserModel;
use Youpi\Auth;
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

        if (request()->isAjax()) {
            if (!$model->validate()) {
                echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
                die;
            }

            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);

            if (!$id = $model->save()) {
                echo json_encode(['status' => 'error', 'data' => 'Error registration']);
                die;
            }

            echo json_encode(['status' => 'success', 'data' => 'Thanks for registration. Your id is ' . $id, 'redirect' => base_url('/login')]);
            die;
        }

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
        return view('user/login', [
            'title' => "Login Page",
        ]);
    }

    public function auth()
    {
        $model = new UserModel();
        $model->loadData();

        if (!$model->validate($model->attributes, [
            'required' => ['email', 'password']
        ])) {
            echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
            die;
        }

        if (Auth::login([
            'email' => $model->attributes['email'],
            'password' => $model->attributes['password']
        ])) {
            echo json_encode(['status' => 'success', 'data' => 'Thanks for login', 'redirect' => base_url('/users')]);
        } else {
            echo json_encode(['status' => 'error', 'data' => 'Wrong email or password']);
        }
        die;
    }

    public function logout()
    {
        Auth::logout();
        response()->redirect(base_url('/login'));
    }

    public function index()
    {
        $usersCount = db()->count('users');
        $pagination = new Pagination($usersCount, 4, 2);
        $users = db()->query("select id, name from users limit {$pagination->getLimit()} offset {$pagination->getOffset()}")->get();

        return view('user/index', [
            'title' => "Index Page",
            'users' => $users,
            'pagination' => $pagination
        ]);
    }

    public function userDetail($userId)
    {
        $user = db()->findOrFail('users', $userId);

        return view('user/detail', [
            'title' => "Detail Page",
            'user' => $user
        ], 'admin');
    }
}
