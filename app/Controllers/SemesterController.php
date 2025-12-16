<?

namespace App\Controllers;

use App\Models\SemesterModel;

class SemesterController extends BaseController
{
    public function list()
    {
        $model = new SemesterModel();
        $semesters = $model->getSemesters();
        return view('admin/semesters', ['title' => "Semester Types Page", 'semesters' => $semesters], 'admin');
    }

    public function create()
    {
        return view('admin/semesters/create', ['title' => "Create Semester Types Page"], 'admin');
    }

    public function store()
    {
        $model = new SemesterModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Семестр успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/semesters/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа занятия');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/semesters/create');
    }

    public function edit($id)
    {
        $model = new SemesterModel();
        $semester = $model->getSemester($id);
        return view('admin/semesters/edit', ['title' => "Edit Room Type Page", 'semester' => $semester], 'admin');
    }

    public function update($id)
    {
        $model = new SemesterModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/semesters/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/semesters/edit/' . $id);
        } else {
            session()->setFlash('success', 'Семестр успешно обновлен');
            response()->redirect('/admin/semesters/');
        }

        cacheRedis()->delete('semesters');
    }

    public function delete($id)
    {
        $model = new SemesterModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Семестр успешно удален');
            cacheRedis()->delete('semesters');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении типа помещения');
        }
        response()->redirect('/admin/semesters/');
    }
}
