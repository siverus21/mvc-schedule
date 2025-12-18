<?

namespace App\Controllers;

use App\Models\ScheduleTemplateModel;
use App\Models\TeacherModel;
use App\Models\SubjectModel;
use App\Models\AuditoryModel;
use App\Models\LessonTypeModel;
use App\Models\StudentGroupModel;

class ScheduleTemplateController extends BaseController
{

    public function list()
    {
        $model = new ScheduleTemplateModel();
        return view('admin/schedule-templates', ['title' => "Schedule Templates Page", 'groups' => $model->getListGroupsWithSemesters()], 'admin');
    }

    public function schedules($semesterId, $groupId)
    {
        $model = new ScheduleTemplateModel();

        $list = $model->getCurrentGroupScheduleTemplates($semesterId, $groupId);
        $group = NULL;

        if (empty($list)) {
            $group = (new StudentGroupModel())->getStudentGroup($groupId);
        }

        return view('admin/schedule-templates/list-current-group', [
            'title' => "Schedule Templates Page",
            'list' => $model->getCurrentGroupScheduleTemplates($semesterId, $groupId),
            'groupId' => $groupId,
            'groupData' => $group,
            'semesterId' => $semesterId
        ], 'admin');
    }

    // public function listSemesters($groupId) {}

    public function create($semesterId, $groupId)
    {
        $teachers = (new TeacherModel())->getAllTeachers();
        $subjects = (new SubjectModel())->getAllSubjects();
        $auditories = (new AuditoryModel())->getAuditoriesWithBuilding();
        $lessonTypes = (new LessonTypeModel())->getLessonTypes();
        $days = getDays();
        return view('admin/schedule-templates/create', [
            'title' => "Create Room Types Page",
            'semesterId' => $semesterId,
            'groupId' => $groupId,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'auditories' => $auditories,
            'lessonTypes' => $lessonTypes,
            'days' => $days
        ], 'admin');
    }

    public function store($semesterId, $groupId)
    {
        $model = new ScheduleTemplateModel();
        $model->loadData();

        $model->attributes['semester_id'] = $semesterId;
        $model->attributes['student_group_id'] = $groupId;
        $model->attributes['start_time'] = date('H:i:s', strtotime($model->attributes['start_time']));
        $model->attributes['end_time'] = date('H:i:s', strtotime($model->attributes['end_time']));

        if ($model->attributes["is_active"] == "on") {
            $model->attributes["is_active"] = 1;
        } else {
            $model->attributes["is_active"] = 0;
        }

        $model->attributes["week_parity"] = 0;  // !!! TODO THIS, пока что костыль !!!
        $model->attributes["ordinal"] = NULL;   // !!! TODO THIS, пока что костыль !!!

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Занятие успешно добавлен. ID = ' . $id);
                response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}");
            } else {
                session()->setFlash('error', 'Ошибка добавления типа аудитории');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/create");
    }

    public function edit($semesterId, $groupId, $itemId)
    {
        $teachers = (new TeacherModel())->getAllTeachers();
        $subjects = (new SubjectModel())->getAllSubjects();
        $auditories = (new AuditoryModel())->getAuditoriesWithBuilding();
        $lessonTypes = (new LessonTypeModel())->getLessonTypes();
        $schedule = (new ScheduleTemplateModel())->getScheduleTemplate($itemId);
        $days = getDays();

        return view('admin/schedule-templates/edit', [
            'title' => "Create Room Types Page",
            'semesterId' => $semesterId,
            'groupId' => $groupId,
            'itemId' => $itemId,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'auditories' => $auditories,
            'lessonTypes' => $lessonTypes,
            'days' => $days,
            'schedule' => $schedule
        ], 'admin');
    }


    public function update($semesterId, $groupId, $itemId)
    {
        $model = new ScheduleTemplateModel();
        $model->loadData();

        $model->attributes['semester_id'] = $semesterId;
        $model->attributes['student_group_id'] = $groupId;
        $model->attributes['start_time'] = date('H:i:s', strtotime($model->attributes['start_time']));
        $model->attributes['end_time'] = date('H:i:s', strtotime($model->attributes['end_time']));

        if ($model->attributes["is_active"] == "on") {
            $model->attributes["is_active"] = 1;
        } else {
            $model->attributes["is_active"] = 0;
        }

        $model->attributes["week_parity"] = 0;  // !!! TODO THIS, пока что костыль !!!
        $model->attributes["ordinal"] = NULL;   // !!! TODO THIS, пока что костыль !!!

        $res = $model->update($itemId);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $itemId);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $itemId);
        } else {
            session()->setFlash('success', 'Занятие успешно обновлено');
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/");
        }

        cacheRedis()->delete('schedules');
    }

    public function delete($semesterId, $groupId, $itemId)
    {
        $model = new ScheduleTemplateModel();
        $model->loadData();
        if ($model->delete($itemId)) {
            session()->setFlash('success', 'Занятие успешно удалено');
            cacheRedis()->delete('schedules');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении занятия');
        }
        response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/");
    }
}
