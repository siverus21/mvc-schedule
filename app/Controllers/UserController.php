<?

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use Youpi\Auth;
use Youpi\Pagination;

class UserController extends BaseController
{

    public function list()
    {
        return view('admin/users', ['title' => "Users Page", 'users' => (new UserModel())->getAllUsers()], 'admin');
    }

    public function create()
    {
        return view('admin/users/create', ['title' => "Register Page", 'roles' => (new RoleModel())->getAllRoles()], 'admin');
    }

    public function store()
    {
        $model = new UserModel();
        $model->loadData();

        // if need ajax
        /*if (request()->isAjax()) {
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
        }*/

        // Сообщения для алертов тянутся из названия файлов.
        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/users/create');
        } else {
            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_ARGON2ID);
            $model->attributes['is_active'] = 1;
            if ($id = $model->save()) {
                session()->setFlash('success', 'Пользователь успешно зарегистрирован. ID = ' . $id);
                response()->redirect('/admin/users');
            } else {
                session()->setFlash('error', 'Ошибка регистрации');
                response()->redirect('/admin/users/create');
            }
        }
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->getUser($id);
        return view('admin/users/edit', ['title' => "Edit User Page", 'user' => $user, 'roles' => (new RoleModel())->getAllRoles()], 'admin');
    }

    public function update($id)
    {
        $model = new UserModel();
        $model->loadData();

        if ($model->attributes['is_active'] == 'on') {
            $model->attributes['is_active'] = 1;
        } else {
            $model->attributes['is_active'] = 0;
        }

        if ($model->attributes['password'] != '') {

            if ($model->attributes['password'] != $model->attributes['confirm-password']) {
                session()->setFlash('error', 'Пароли не совпадают');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
                response()->redirect('/admin/users/edit/' . $id);
            } else {
                $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_ARGON2ID);
                unset($model->attributes['confirm-password']);
                unset($model->rules['equals']);
                unset($model->rules['lengthMin']);
                foreach ($model->rules['required'] as $key => $value) {
                    if ($value == 'password' || $value == 'confirm-password') {
                        unset($model->rules['required'][$key]);
                    }
                }
            }
        } else {
            unset($model->attributes['password']);
            unset($model->attributes['confirm-password']);
            unset($model->rules['equals']);
            unset($model->rules['lengthMin']);
            foreach ($model->rules['required'] as $key => $value) {
                if ($value == 'password' || $value == 'confirm-password') {
                    unset($model->rules['required'][$key]);
                }
            }
        }

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/users/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/users/edit/' . $id);
        } else {
            session()->setFlash('success', 'Данные пользователя успешно изменены');
            response()->redirect('/admin/users');
        }
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        response()->redirect('/admin/users');
    }

    public function login()
    {
        return view('user/login', [
            'title' => "Login Page",
        ], 'admin');
    }

    public function auth()
    {
        $model = new UserModel();
        $model->loadData();

        /*if need ajax
        if (request()->isAjax()) {
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
        }*/

        if (!$model->validate($model->attributes, [
            'required' => ['email', 'password']
        ])) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        }

        if (Auth::login([
            'email' => $model->attributes['email'],
            'password' => $model->attributes['password']
        ])) {
            session()->setFlash('success', 'Успешная авторизация');
            response()->redirect('/admin');
        } else {
            session()->setFlash('error', 'Неправильный email или пароль');
            response()->redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        response()->redirect(base_url('/login'));
    }

    /*public function index()
    {
        $usersCount = db()->count('users');
        $pagination = new Pagination($usersCount, 4, 2);
        $users = db()->query("select id, name from users limit {$pagination->getLimit()} offset {$pagination->getOffset()}")->get();

        return view('user/index', [
            'title' => "Index Page",
            'users' => $users,
            'pagination' => $pagination
        ], 'admin');
    }*/
}
