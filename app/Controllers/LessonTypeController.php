<?

namespace App\Controllers;

use App\Models\LessonTypeModel;

class LessonTypeController extends BaseController
{
    public function list()
    {
        $model = new LessonTypeModel();
        $lessonTypes = $model->getLessonTypes();
        return view('admin/lesson-types', ['title' => 'Типы занятий', 'lessonTypes' => $lessonTypes], 'admin');
    }

    public function create()
    {
        return view('admin/lesson-types/create', ['title' => 'Добавить тип занятия'], 'admin');
    }

    public function store()
    {
        $model = new LessonTypeModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Тип занятия успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/lesson-types/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления типа занятия');
            }
        }
        response()->redirect('/admin/lesson-types/create');
    }

    public function edit($id)
    {
        $model = new LessonTypeModel();
        $lessonType = $model->getLessonType($id);
        return view('admin/lesson-types/edit', ['title' => 'Редактировать тип занятия', 'lessonType' => $lessonType], 'admin');
    }

    public function update($id)
    {
        $model = new LessonTypeModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/lesson-types/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/lesson-types/edit/' . $id);
        } else {
            session()->setFlash('success', 'Тип занятия успешно обновлён');
            response()->redirect('/admin/lesson-types/');
        }

        cacheRedis()->delete('lesson-types');
    }

    public function delete($id)
    {
        $model = new LessonTypeModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Тип занятия успешно удалён');
            cacheRedis()->delete('lesson-types');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении типа занятия');
        }
        response()->redirect('/admin/lesson-types/');
    }
}
