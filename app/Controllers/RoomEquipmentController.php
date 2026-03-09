<?

namespace App\Controllers;

use App\Models\RoomEquipmentModel;

class RoomEquipmentController extends BaseController
{
    public function list()
    {
        $data = (new RoomEquipmentModel())->getAllData();
        $res = [];
        foreach ($data as $item) {
            $res[$item['room_id_pk']]['room_name'] = $item['room_name'];
            $res[$item['room_id_pk']]['items'][] = $item;
        }
        return view('admin/room_equipment', ['title' => 'Оборудование аудиторий', 'equipmentTypes' => $res], 'admin');
    }

    public function create()
    {
        $model = new RoomEquipmentModel();
        return view('admin/room-equipment/create', ['title' => 'Добавить оборудование', 'rooms' => $model->getAllRooms(), 'equipmentTypes' => $model->getAllEquipmentTypes()], 'admin');
    }

    public function store()
    {
        $model = new RoomEquipmentModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            if ($model->save()) {
                session()->setFlash('success', 'Оборудование успешно добавлено.');
                response()->redirect('/admin/room-equipment/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления оборудования');
            }
        }
        response()->redirect('/admin/room-equipment/create');
    }

    public function edit($id)
    {
        $model = new RoomEquipmentModel();
        return view('admin/room-equipment/edit', ['title' => 'Редактировать оборудование', 'rooms' => $model->getAllRooms(), 'equipmentTypes' => $model->getAllEquipmentTypes(), 'roomEquipment' => $model->getCurrentRoomEquipment($id)], 'admin');
    }

    public function update($id)
    {
        $model = new RoomEquipmentModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/room-equipment/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/room-equipment/edit/' . $id);
        } else {
            session()->setFlash('success', 'Оборудование успешно обновлено');
            response()->redirect('/admin/room-equipment/');
        }
    }

    public function delete($id)
    {
        $model = new RoomEquipmentModel();
        $model->delete($id);
        response()->redirect('/admin/room-equipment');
    }
}
