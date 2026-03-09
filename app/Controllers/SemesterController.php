<?

namespace App\Controllers;

use App\Models\SemesterModel;

class SemesterController extends BaseController
{
    public function list()
    {
        $model = new SemesterModel();
        $semesters = $model->getSemesters();
        return view('admin/semesters', ['title' => 'Семестры', 'semesters' => $semesters], 'admin');
    }

    public function create()
    {
        return view('admin/semesters/create', ['title' => 'Добавить семестр'], 'admin');
    }

    public function store()
    {
        $model = new SemesterModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Семестр успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/semesters/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления семестра');
            }
        }
        response()->redirect('/admin/semesters/create');
    }

    public function edit($id)
    {
        $model = new SemesterModel();
        $semester = $model->getSemester($id);
        return view('admin/semesters/edit', ['title' => 'Редактировать семестр', 'semester' => $semester], 'admin');
    }

    public function update($id)
    {
        $model = new SemesterModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/semesters/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/semesters/edit/' . $id);
        } else {
            session()->setFlash('success', 'Семестр успешно обновлён');
            response()->redirect('/admin/semesters/');
        }

        cacheRedis()->delete('semesters');
    }

    public function delete($id)
    {
        $model = new SemesterModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Семестр успешно удалён');
            cacheRedis()->delete('semesters');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении семестра');
        }
        response()->redirect('/admin/semesters/');
    }
}
