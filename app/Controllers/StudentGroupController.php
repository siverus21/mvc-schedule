<?

namespace App\Controllers;

use App\Models\StudentGroupModel;

class StudentGroupController extends BaseController
{
    public function list()
    {
        $model = new StudentGroupModel();
        $studentGroups = $model->getStudentGroups();
        return view('admin/student-groups', ['title' => 'Учебные группы', 'studentGroups' => $studentGroups], 'admin');
    }

    public function create()
    {
        return view('admin/student-groups/create', ['title' => 'Добавить группу'], 'admin');
    }

    public function store()
    {
        $model = new StudentGroupModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Группа успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/student-groups/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления группы');
            }
        }
        response()->redirect('/admin/student-groups/create');
    }

    public function edit($id)
    {
        $model = new StudentGroupModel();
        $studentGroup = $model->getStudentGroup($id);
        return view('admin/student-groups/edit', ['title' => 'Редактировать группу', 'studentGroup' => $studentGroup], 'admin');
    }

    public function update($id)
    {
        $model = new StudentGroupModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
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
            session()->setFlash('success', 'Группа успешно удалена');
            cacheRedis()->delete('student-groups');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении группы');
        }
        response()->redirect('/admin/student-groups/');
    }
}
