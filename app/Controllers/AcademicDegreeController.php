<?

namespace App\Controllers;

use App\Models\AcademicDegreeModel;

class AcademicDegreeController extends BaseController
{
    public function list()
    {
        $model = new AcademicDegreeModel();
        $academicDegrees = $model->getAllAcademicDegrees();
        return view('admin/academic-degrees', ['title' => 'Учёные степени', 'academicDegrees' => $academicDegrees], 'admin');
    }

    public function create()
    {
        return view('admin/academic-degrees/create', ['title' => 'Добавить учёную степень'], 'admin');
    }

    public function store()
    {
        $model = new AcademicDegreeModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Учёная степень успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/academic-degrees/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления учёной степени');
            }
        }
        response()->redirect('/admin/academic-degrees/create');
    }

    public function edit($id)
    {
        $model = new AcademicDegreeModel();
        $academicDegree = $model->getAcademicDegree($id);
        return view('admin/academic-degrees/edit', ['title' => 'Редактировать учёную степень', 'academicDegree' => $academicDegree], 'admin');
    }

    public function update($id)
    {
        $model = new AcademicDegreeModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/academic-degrees/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/academic-degrees/edit/' . $id);
        } else {
            session()->setFlash('success', 'Учёная степень успешно обновлена');
            response()->redirect('/admin/academic-degrees/');
        }

        cacheRedis()->delete('academic-degrees');
    }

    public function delete($id)
    {
        $model = new AcademicDegreeModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Учёная степень успешно удалена');
            cacheRedis()->delete('academic-degrees');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении учёной степени');
        }
        response()->redirect('/admin/academic-degrees/');
    }
}
