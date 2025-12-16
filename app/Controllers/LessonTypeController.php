<?

namespace App\Controllers;

use App\Models\LessonTypeModel;

class LessonTypeController extends BaseController
{
    public function list()
    {
        $model = new LessonTypeModel();
        $lessonTypes = $model->getLessonTypes();
        return view('admin/lesson-types', ['title' => "Lesson Types Page", 'lessonTypes' => $lessonTypes], 'admin');
    }

    public function create()
    {
        return view('admin/lesson-types/create', ['title' => "Create Lesson Types Page"], 'admin');
    }

    public function store()
    {
        $model = new LessonTypeModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Тип занятия успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/lesson-types/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа занятия');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/lesson-types/create');
    }

    public function edit($id)
    {
        $model = new LessonTypeModel();
        $lessonType = $model->getLessonType($id);
        return view('admin/lesson-types/edit', ['title' => "Edit Room Type Page", 'lessonType' => $lessonType], 'admin');
    }

    public function update($id)
    {
        $model = new LessonTypeModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/lesson-types/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/lesson-types/edit/' . $id);
        } else {
            session()->setFlash('success', 'Тип занятия успешно обновлен');
            response()->redirect('/admin/lesson-types/');
        }

        cacheRedis()->delete('lesson-types');
    }

    public function delete($id)
    {
        $model = new LessonTypeModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Тип занятия успешно удален');
            cacheRedis()->delete('lesson-types');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении типа помещения');
        }
        response()->redirect('/admin/lesson-types/');
    }
}
