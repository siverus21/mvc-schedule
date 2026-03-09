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
        return view('admin/users', ['title' => 'Пользователи', 'users' => (new UserModel())->getAllUsers()], 'admin');
    }

    public function create()
    {
        return view('admin/users/create', ['title' => 'Регистрация', 'roles' => (new RoleModel())->getAllRoles()], 'admin');
    }

    public function store()
    {
        $model = new UserModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/users/create');
            return;
        }

        $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_ARGON2ID);
        $model->attributes['is_active'] = 1;
        if ($id = $model->save()) {
            session()->setFlash('success', 'Пользователь успешно зарегистрирован. ID = ' . $id);
            response()->redirect('/admin/users');
        } else {
            $this->rememberFormErrors($model, 'Ошибка регистрации');
            response()->redirect('/admin/users/create');
        }
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->getUser($id);
        return view('admin/users/edit', ['title' => 'Редактировать пользователя', 'user' => $user, 'roles' => (new RoleModel())->getAllRoles()], 'admin');
    }

    public function update($id)
    {
        $model = new UserModel();
        $model->loadData();

        $model->attributes['is_active'] = ($model->attributes['is_active'] ?? '') === 'on' ? 1 : 0;

        if (($model->attributes['password'] ?? '') !== '') {
            if ($model->attributes['password'] !== ($model->attributes['confirm-password'] ?? '')) {
                $this->rememberFormErrors($model, 'Пароли не совпадают');
                response()->redirect('/admin/users/edit/' . $id);
                return;
            }
            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_ARGON2ID);
            unset($model->attributes['confirm-password']);
            unset($model->rules['equals'], $model->rules['lengthMin']);
            if (isset($model->rules['required'])) {
                $model->rules['required'] = array_values(array_filter($model->rules['required'], fn($v) => $v !== 'password' && $v !== 'confirm-password'));
            }
        } else {
            unset($model->attributes['password'], $model->attributes['confirm-password']);
            unset($model->rules['equals'], $model->rules['lengthMin']);
            if (isset($model->rules['required'])) {
                $model->rules['required'] = array_values(array_filter($model->rules['required'], fn($v) => $v !== 'password' && $v !== 'confirm-password'));
            }
        }

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
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
        return view('user/login', ['title' => 'Вход'], 'admin');
    }

    public function auth()
    {
        $model = new UserModel();
        $model->loadData();

        if (!$model->validate($model->attributes, ['required' => ['email', 'password']])) {
            $this->rememberFormErrors($model, 'Ошибка валидации');
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
}
