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
            $res[$item['room_id_pk']]["items"][] = $item;
        }
        // dd($res);
        return view('admin/room_equipment', ['title' => "Room Equipment Types Page", 'equipmentTypes' => $res], 'admin');
    }

    public function create()
    {
        $model = new RoomEquipmentModel();
        return view('admin/room-equipment/create', ['title' => "Create Equipment Types Page", "rooms" => $model->getAllRooms(), "equipmentTypes" => $model->getAllEquipmentTypes()], 'admin');
    }

    public function store()
    {
        $model = new RoomEquipmentModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($model->save()) {
                session()->setFlash('success', 'Тип оборудования успешно добавлен.');
                response()->redirect('/admin/room-equipment/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа оборудования');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/room-equipment/create');
    }

    public function edit($id)
    {
        $model = new RoomEquipmentModel();
        return view('admin/room-equipment/edit', ['title' => "Edit Equipment Types Page", "rooms" => $model->getAllRooms(), "equipmentTypes" => $model->getAllEquipmentTypes(), "roomEquipment" => $model->getCurrentRoomEquipment($id)], 'admin');
    }

    public function update($id)
    {
        $model = new RoomEquipmentModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/room-equipment/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/room-equipment/edit/' . $id);
        } else {
            session()->setFlash('success', 'Тип оборудования успешно обновлен');
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
