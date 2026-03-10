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
        return view('admin/schedule-templates', ['title' => 'Шаблоны расписания', 'groups' => $model->getListGroupsWithSemesters()], 'admin');
    }

    public function schedules($semesterId, $groupId)
    {
        $model = new ScheduleTemplateModel();
        $list = $model->getCurrentGroupScheduleTemplates($semesterId, $groupId);
        $group = null;

        if (empty($list)) {
            $group = (new StudentGroupModel())->getStudentGroup($groupId);
        }

        return view('admin/schedule-templates/list-current-group', [
            'title' => 'Расписание группы',
            'list' => $model->getCurrentGroupScheduleTemplates($semesterId, $groupId),
            'groupId' => $groupId,
            'groupData' => $group,
            'semesterId' => $semesterId,
            'weekParity' => getWeekParity()
        ], 'admin');
    }

    public function create($semesterId, $groupId)
    {
        $teachers = (new TeacherModel())->getAllTeachers();
        $subjects = (new SubjectModel())->getAllSubjects();
        $auditories = (new AuditoryModel())->getAuditoriesWithBuilding();
        $lessonTypes = (new LessonTypeModel())->getLessonTypes();
        $days = getDays();
        $weekParity = getWeekParity();
        return view('admin/schedule-templates/create', [
            'title' => 'Добавить занятие',
            'semesterId' => $semesterId,
            'groupId' => $groupId,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'auditories' => $auditories,
            'lessonTypes' => $lessonTypes,
            'days' => $days,
            'weekParity' => $weekParity
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
        $model->attributes['is_active'] = $model->attributes['is_active'] == 'on' ? 1 : 0;
        $model->attributes['notes'] = trim($model->attributes['notes'] ?? '') === '' ? null : $model->attributes['notes'];
        $model->attributes['ordinal'] = null;   // TODO

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/create");
            return;
        }

        // Проверяем пересечения по времени, но не блокируем сохранение — только предупреждаем
        $conflicts = $model->findTimeConflicts(
            $semesterId,
            $groupId,
            $model->attributes['teacher_id'],
            (int) $model->attributes['day_of_week'],
            (int) ($model->attributes['week_parity'] ?? 0),
            $model->attributes['start_time'],
            $model->attributes['end_time'],
            null
        );
        if (!empty($conflicts)) {
            session()->setFlash('info', implode(' ', $conflicts));
        }

        if ($id = $model->save()) {
            cache()->delete('schedules');
            cache()->delete('api:schedule:' . $semesterId . ':' . $groupId);
            session()->setFlash('success', 'Занятие успешно добавлено. ID = ' . $id);
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}");
        } else {
            $this->rememberFormErrors($model, 'Ошибка добавления занятия');
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/create");
        }
    }

    public function edit($semesterId, $groupId, $itemId)
    {
        $teachers = (new TeacherModel())->getAllTeachers();
        $subjects = (new SubjectModel())->getAllSubjects();
        $auditories = (new AuditoryModel())->getAuditoriesWithBuilding();
        $lessonTypes = (new LessonTypeModel())->getLessonTypes();
        $schedule = (new ScheduleTemplateModel())->getScheduleTemplate($itemId);
        $days = getDays();
        $weekParity = getWeekParity();

        return view('admin/schedule-templates/edit', [
            'title' => 'Редактировать занятие',
            'semesterId' => $semesterId,
            'groupId' => $groupId,
            'itemId' => $itemId,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'auditories' => $auditories,
            'lessonTypes' => $lessonTypes,
            'days' => $days,
            'schedule' => $schedule,
            'weekParity' => $weekParity
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
        $model->attributes['is_active'] = $model->attributes['is_active'] == 'on' ? 1 : 0;
        $model->attributes['notes'] = trim($model->attributes['notes'] ?? '') === '' ? null : $model->attributes['notes'];
        $model->attributes['ordinal'] = null;   // TODO

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $itemId);
            return;
        }

        // Проверка пересечений по времени — только предупреждение, не блокируем обновление
        $conflicts = $model->findTimeConflicts(
            $semesterId,
            $groupId,
            $model->attributes['teacher_id'],
            (int) $model->attributes['day_of_week'],
            (int) ($model->attributes['week_parity'] ?? 0),
            $model->attributes['start_time'],
            $model->attributes['end_time'],
            $itemId
        );
        if (!empty($conflicts)) {
            session()->setFlash('info', implode(' ', $conflicts));
        }

        $res = $model->update($itemId);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $itemId);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/edit/" . $itemId);
        } else {
            session()->setFlash('success', 'Занятие успешно обновлено');
            response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/");
        }

        cache()->delete('schedules');
        cache()->delete('api:schedule:' . $semesterId . ':' . $groupId);
    }

    public function delete($semesterId, $groupId, $itemId)
    {
        $model = new ScheduleTemplateModel();
        $model->loadData();
        if ($model->delete($itemId)) {
            session()->setFlash('success', 'Занятие успешно удалено');
            cache()->delete('schedules');
            cache()->delete('api:schedule:' . $semesterId . ':' . $groupId);
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении занятия');
        }
        response()->redirect("/admin/schedules/semester/{$semesterId}/group/{$groupId}/");
    }
}
