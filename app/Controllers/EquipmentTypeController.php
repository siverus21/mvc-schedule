<?

namespace App\Controllers;

use App\Models\EquipmentTypeModel;

class EquipmentTypeController extends BaseController
{
    public function list()
    {
        return view('admin/equipment_types', ['title' => "Equipment Types Page", 'equipmentTypes' => $this->getEquipmentTypes()], 'admin');
    }

    public function create()
    {
        return view('admin/equipment-types/create', ['title' => "Create Equipment Types Page"], 'admin');
    }

    public function store()
    {
        $model = new EquipmentTypeModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($id = $model->save()) {
                session()->setFlash('success', 'Тип оборудования успешно добавлен. ID = ' . $id);
                response()->redirect('/admin/equipment-types/');
            } else {
                session()->setFlash('error', 'Ошибка добавления типа оборудования');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/equipment-types/create');
    }

    public function edit($id)
    {
        $model = new EquipmentTypeModel();
        $equipmentType = $model->getEquipmentType($id);
        return view('admin/equipment-types/edit', ['title' => "Edit Equipment Type Page", 'equipmentType' => $equipmentType], 'admin');
    }

    public function update($id)
    {
        $model = new EquipmentTypeModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
            response()->redirect('/admin/equipment-types/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/equipment-types/edit/' . $id);
        } else {
            session()->setFlash('success', 'Тип обоборудования успешно обновлен');
            response()->redirect('/admin/equipment-types/');
        }

        cacheRedis()->delete('equipment_types');
    }

    public function delete($id)
    {
        $model = new EquipmentTypeModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Тип оборудования успешно удален');
            cacheRedis()->delete('equipment-types');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении типа оборудования');
        }
        response()->redirect('/admin/equipment-types/');
    }

    public function getEquipmentTypes()
    {
        $model = new EquipmentTypeModel();
        return $model->getEquipmentTypes();
    }
}
