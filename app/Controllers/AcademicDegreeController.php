<?

namespace App\Controllers;

use App\Models\AcademicDegreeModel;

class AcademicDegreeController extends BaseController
{
    public function list()
    {
        $model = new AcademicDegreeModel();
        $academicDegrees = $model->getAllAcademicDegrees();
        return view('admin/academic-degrees', ['title' => "Room Types Page", 'academicDegrees' => $academicDegrees], 'admin');
    }

    public function create()
    {
        return view('admin/academic-degrees/create', ['title' => "Create Room Types Page"], 'admin');
    }

    public function store()
    {
        $model = new AcademicDegreeModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Тип аудитории успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/academic-degrees/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа аудитории');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/academic-degrees/create');
    }

    public function edit($id)
    {
        $model = new AcademicDegreeModel();
        $academicDegree = $model->getAcademicDegree($id);
        return view('admin/academic-degrees/edit', ['title' => "Edit Room Type Page", 'academicDegree' => $academicDegree], 'admin');
    }

    public function update($id)
    {
        $model = new AcademicDegreeModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/academic-degrees/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/academic-degrees/edit/' . $id);
        } else {
            session()->setFlash('success', 'Тип помещения успешно обновлен');
            response()->redirect('/admin/academic-degrees/');
        }

        cacheRedis()->delete('academic-degrees');
    }

    public function delete($id)
    {
        $model = new AcademicDegreeModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Тип помещения успешно удален');
            cacheRedis()->delete('academic-degrees');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении типа помещения');
        }
        response()->redirect('/admin/academic-degrees/');
    }
}
