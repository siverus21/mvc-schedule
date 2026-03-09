<?

namespace App\Controllers;

use App\Models\SubjectModel;

class SubjectController extends BaseController
{
    public function list()
    {
        $model = new SubjectModel();
        return view('admin/subjects', ['title' => 'Дисциплины', 'subjects' => $model->getAllSubjects()], 'admin');
    }

    public function create()
    {
        return view('admin/subjects/create', ['title' => 'Добавить дисциплину'], 'admin');
    }

    public function store()
    {
        $model = new SubjectModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Дисциплина успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/subjects/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления дисциплины');
            }
        }
        response()->redirect('/admin/subjects/create');
    }

    public function edit($id)
    {
        $model = new SubjectModel();
        $subject = $model->getSubject($id);
        return view('admin/subjects/edit', ['title' => 'Редактировать дисциплину', 'subject' => $subject], 'admin');
    }

    public function update($id)
    {
        $model = new SubjectModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/subjects/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/subjects/edit/' . $id);
        } else {
            session()->setFlash('success', 'Дисциплина успешно обновлена');
            response()->redirect('/admin/subjects/');
        }

        cacheRedis()->delete('subjects');
    }

    public function delete($id)
    {
        $model = new SubjectModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Дисциплина успешно удалена');
            cacheRedis()->delete('subjects');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении дисциплины');
        }
        response()->redirect('/admin/subjects/');
    }
}
