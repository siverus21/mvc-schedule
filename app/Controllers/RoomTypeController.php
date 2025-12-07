<?

namespace App\Controllers;

use App\Models\RoomTypeModel;

class RoomTypeController extends BaseController
{
    public function list()
    {
        return view('admin/room_types', ['title' => "Room Types Page", 'roomTypes' => $this->getRoomTypes()], 'admin');
    }

    public function create()
    {
        return view('admin/room-types/create', ['title' => "Create Room Types Page"], 'admin');
    }

    public function store()
    {
        $model = new RoomTypeModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Тип аудитории успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/room-types/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа аудитории');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/room-types/create');
    }

    public function edit($id)
    {
        $model = new RoomTypeModel();
        $roomType = $model->getRoomType($id);
        return view('admin/room-types/edit', ['title' => "Edit Room Type Page", 'roomType' => $roomType], 'admin');
    }

    public function update($id)
    {
        $model = new RoomTypeModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/room-types/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/room-types/edit/' . $id);
        } else {
            session()->setFlash('success', 'Тип помещения успешно обновлен');
            response()->redirect('/admin/room-types/');
        }

        cacheRedis()->delete('room-types');
    }

    public function delete($id)
    {
        $model = new RoomTypeModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Тип помещения успешно удален');
            cacheRedis()->delete('room-types');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении типа помещения');
        }
        response()->redirect('/admin/room-types/');
    }

    public function getRoomTypes()
    {
        $model = new RoomTypeModel();
        return $model->getRoomTypes();
    }
}
