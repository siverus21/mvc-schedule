<?

namespace App\Controllers;

use App\Models\StudentGroupModel;

class StudentGroupController extends BaseController
{
    public function list()
    {
        $model = new StudentGroupModel();
        $studentGroups = $model->getStudentGroups();
        return view('admin/student-groups', ['title' => "Room Types Page", 'studentGroups' => $studentGroups], 'admin');
    }

    public function create()
    {
        return view('admin/student-groups/create', ['title' => "Create Room Types Page"], 'admin');
    }

    public function store()
    {
        $model = new StudentGroupModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Группа успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/student-groups/');
            } else {
                session()->setFlash('error', 'Ошибка добавления группы');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/student-groups/create');
    }

    public function edit($id)
    {
        $model = new StudentGroupModel();
        $studentGroup = $model->getStudentGroup($id);
        return view('admin/student-groups/edit', ['title' => "Edit Room Type Page", 'studentGroup' => $studentGroup], 'admin');
    }

    public function update($id)
    {
        $model = new StudentGroupModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/student-groups/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/student-groups/edit/' . $id);
        } else {
            session()->setFlash('success', 'Группа успешно обновлена');
            response()->redirect('/admin/student-groups/');
        }

        cacheRedis()->delete('student-groups');
    }

    public function delete($id)
    {
        $model = new StudentGroupModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Группа успешно удален');
            cacheRedis()->delete('student-groups');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении группы');
        }
        response()->redirect('/admin/student-groups/');
    }
}
