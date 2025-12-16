<?

namespace App\Controllers;

use App\Models\SubjectModel;

class SubjectController extends BaseController
{
    public function list()
    {
        $model = new SubjectModel();
        return view('admin/subjects', ['title' => "Room Types Page", 'subjects' => $model->getAllSubjects()], 'admin');
    }

    public function create()
    {
        return view('admin/subjects/create', ['title' => "Create Room Types Page"], 'admin');
    }

    public function store()
    {
        $model = new SubjectModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Дисциплина успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/subjects/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа аудитории');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/subjects/create');
    }

    public function edit($id)
    {
        $model = new SubjectModel();
        $subject = $model->getSubject($id);
        return view('admin/subjects/edit', ['title' => "Edit Room Type Page", 'subject' => $subject], 'admin');
    }

    public function update($id)
    {
        $model = new SubjectModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
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
            session()->setFlash('error', 'Произошла ошибка при удалении типа помещения');
        }
        response()->redirect('/admin/subjects/');
    }
}
