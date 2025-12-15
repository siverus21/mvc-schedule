<?

namespace App\Controllers;

use Youpi\Controller;
use App\Models\DepartmentModel;

class DepartmentController extends Controller
{
    public function list()
    {
        $model = new DepartmentModel();
        return view('admin/department', ['title' => "Department Page", 'departments' => $model->getAllDepartments()], 'admin');
    }

    public function create()
    {
        return view('admin/department/create', ['title' => "Create Department Page"], 'admin');
    }

    public function store()
    {
        $model = new DepartmentModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            $model->attributes['created_at'] = date('Y-m-d H:i:s');
            if ($id = $model->save()) {
                session()->setFlash('success', 'Кафедра успешно добавлено. ID = ' . $id);
                response()->redirect('/admin/department/');
            } else {
                session()->setFlash('error', 'Ошибка добавления здания');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/department/create');
    }

    public function edit($id)
    {
        $model = new DepartmentModel();
        $department = $model->getDepartment($id);
        return view('admin/department/edit', ['title' => "Edit department Page", 'department' => $department], 'admin');
    }

    public function update($id)
    {
        $model = new DepartmentModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/department/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/department/edit/' . $id);
        } else {
            session()->setFlash('success', 'Кафедра успешно обновлено');
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
            session()->setFlash('error', 'Произошла ошибка при удалении здания');
        }
        response()->redirect('/admin/department/');
    }
}
