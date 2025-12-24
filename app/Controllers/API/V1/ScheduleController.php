<?

namespace App\Controllers\API\V1;

use App\Models\ScheduleTemplateModel;

class ScheduleController
{

    public function index()
    {
        $data = $this->checkRequest();

        if (!$data['group']) {
            response()->json([
                'status' => 'error',
                'message' => view()->renderPartial('incs/alert_info', [
                    'flash_info' => 'Группа не указана.',
                ]),
            ], 400);
            exit;
        }

        $schedule = $this->schedules('1', $data['group']);

        if ($schedule === null) {
            response()->json([
                'status' => 'error',
                'message' => view()->renderPartial('incs/alert_info', [
                    'flash_info' => 'Расписание не найдено для указанной группы.',
                ]),
            ], 200);
            exit;
        }

        response()->json([
            'status' => 'ok',
            'message' => $schedule,
        ]);
    }

    public function checkRequest()
    {
        $data = request()->getData();

        if (empty($data)) {
            response()->json([
                'status' => 'error',
                'message' => 'No data provided',
            ], 400);
            exit;
        }

        foreach ($data as $key => $value) {
            $data[$key] = h($value);
        }
        return $data;
    }

    public function schedules($semesterId, $groupId)
    {
        $model = new ScheduleTemplateModel();

        $list = $model->getCurrentGroupScheduleTemplates($semesterId, $groupId, true, true);

        if (empty($list)) {
            return null;
        } else {
            foreach ($list['days'] as $day => $weekParity) {
                $lesson = [];
                if (empty($weekParity)) {
                    continue;
                }

                foreach ($weekParity as $schedule) {
                    foreach ($schedule as $les) {
                        $lesson[] = $les;
                    }
                }

                uasort($lesson, function ($a, $b) {
                    return strcmp($a['start_time'], $b['start_time']);;
                });

                $list['days'][$day] = $lesson;
            }
        }

        return view()->renderPartial('incs/schedule', [
            'list' => $list,
            'weekParity' => getWeekParity()
        ]);
    }
}
