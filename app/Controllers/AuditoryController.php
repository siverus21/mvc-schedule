<?

namespace App\Controllers;

use App\Models\RoomTypeModel;
use App\Models\BuildingModel;
use App\Models\AuditoryModel;

class AuditoryController extends BaseController
{
    public function list()
    {
        $model = new AuditoryModel();
        return view('admin/auditories', ['title' => 'Аудитории', 'auditories' => $model->getListData()], 'admin');
    }

    public function create()
    {
        $buildingsModel = new BuildingModel();
        $roomTypesModel = new RoomTypeModel();
        return view('admin/auditories/create', ['title' => 'Добавить аудиторию', 'buildings' => $buildingsModel->getBuildings(), 'roomTypes' => $roomTypesModel->getRoomTypes()], 'admin');
    }

    public function store()
    {
        $model = new AuditoryModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Аудитория успешно добавлена. ID = ' . $id);
                response()->redirect('/admin/auditories/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления аудитории');
            }
        }
        response()->redirect('/admin/auditories/create');
    }

    public function edit($id)
    {
        $buildingsModel = (new BuildingModel())->getBuildings();
        $roomTypesModel = (new RoomTypeModel())->getRoomTypes();
        $auditory = (new AuditoryModel())->getAuditory($id);
        return view('admin/auditories/edit', ['title' => 'Редактировать аудиторию', 'auditory' => $auditory, 'buildings' => $buildingsModel, 'roomTypes' => $roomTypesModel], 'admin');
    }

    public function update($id)
    {
        $model = new AuditoryModel();
        $model->loadData();
        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/auditories/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/auditories/edit/' . $id);
        } else {
            session()->setFlash('success', 'Аудитория успешно обновлена');
            response()->redirect('/admin/auditories/');
        }
    }

    public function delete($id)
    {
        $model = new AuditoryModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Аудитория успешно удалена');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении аудитории');
        }
        response()->redirect('/admin/auditories/');
    }
}
