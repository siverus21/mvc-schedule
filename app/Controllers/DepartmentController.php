<?

namespace App\Controllers;

use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    public function list()
    {
        $model = new DepartmentModel();
        return view('admin/department', ['title' => 'Кафедры', 'departments' => $model->getAllDepartments()], 'admin');
    }

    public function create()
    {
        return view('admin/department/create', ['title' => 'Добавить кафедру'], 'admin');
    }

    public function store()
    {
        $model = new DepartmentModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            $model->attributes['created_at'] = date('Y-m-d H:i:s');
            if ($id = $model->save()) {
                session()->setFlash('success', 'Кафедра успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/department/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления кафедры');
            }
        }
        response()->redirect('/admin/department/create');
    }

    public function edit($id)
    {
        $model = new DepartmentModel();
        $department = $model->getDepartment($id);
        return view('admin/department/edit', ['title' => 'Редактировать кафедру', 'department' => $department], 'admin');
    }

    public function update($id)
    {
        $model = new DepartmentModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/department/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/department/edit/' . $id);
        } else {
            session()->setFlash('success', 'Кафедра успешно обновлена');
            response()->redirect('/admin/department/');
        }

        cacheRedis()->delete('department');
    }

    public function delete($id)
    {
        $model = new DepartmentModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Кафедра успешно удалена');
            cacheRedis()->delete('department');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении кафедры');
        }
        response()->redirect('/admin/department/');
    }
}
