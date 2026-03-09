<?

namespace App\Controllers;

use App\Models\TeacherModel;
use App\Models\UserModel;
use App\Models\AcademicDegreeModel;
use App\Models\DepartmentModel;

class TeacherController extends BaseController
{
    public function list()
    {
        $model = new TeacherModel();
        $teachers = $model->getAllTeachers();
        return view('admin/teachers', ['title' => 'Преподаватели', 'teachers' => $teachers], 'admin');
    }

    public function create()
    {
        $department = (new DepartmentModel())->getAllDepartments();
        $academicDegree = (new AcademicDegreeModel())->getAllAcademicDegrees();
        $users = (new UserModel())->getUsersTeacherButNoInTableTeacher();
        return view('admin/teachers/create', ['title' => 'Добавить преподавателя', 'department' => $department, 'academicDegree' => $academicDegree, 'users' => $users], 'admin');
    }

    public function store()
    {
        $model = new TeacherModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            $model->attributes['created_at'] = date('Y-m-d H:i:s');
            if ($id = $model->save()) {
                session()->setFlash('success', 'Преподаватель успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/teachers/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления преподавателя');
            }
        }
        response()->redirect('/admin/teachers/create');
    }

    public function edit($id)
    {
        $department = (new DepartmentModel())->getAllDepartments();
        $academicDegree = (new AcademicDegreeModel())->getAllAcademicDegrees();
        $users = (new UserModel())->getAllUsers();
        $teacher = (new TeacherModel())->getTeacher($id);
        return view('admin/teachers/edit', ['title' => 'Редактировать преподавателя', 'department' => $department, 'academicDegree' => $academicDegree, 'users' => $users, 'teacher' => $teacher], 'admin');
    }

    public function update($id)
    {
        $model = new TeacherModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/teachers/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/teachers/edit/' . $id);
        } else {
            session()->setFlash('success', 'Преподаватель успешно обновлён');
            response()->redirect('/admin/teachers/');
        }

        cacheRedis()->delete('teachers');
    }

    public function delete($id)
    {
        $model = new TeacherModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Преподаватель успешно удалён');
            cacheRedis()->delete('teachers');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении преподавателя');
        }
        response()->redirect('/admin/teachers/');
    }
}
