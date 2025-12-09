<?

namespace App\Controllers;

use App\Models\RoomEquipmentModel;

class RoomEquipmentController extends BaseController
{
    public function list()
    {
        return view('admin/room_equipment', ['title' => "Room Equipment Types Page", 'equipmentTypes' => ""], 'admin');
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
}
