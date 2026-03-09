<?

namespace App\Controllers;

use App\Models\BuildingModel;

class BuildingController extends BaseController
{
    public function list()
    {
        return view('admin/buildings', ['title' => 'Здания', 'buildings' => $this->getBuildings()], 'admin');
    }

    public function create()
    {
        return view('admin/buildings/create', ['title' => 'Добавить здание'], 'admin');
    }

    public function store()
    {
        $model = new BuildingModel();
        $model->loadData();

        if (!$model->validate()) {
            $this->rememberFormErrors($model);
        } else {
            $model->attributes['created_at'] = date('Y-m-d H:i:s');
            if ($id = $model->save()) {
                session()->setFlash('success', 'Здание успешно добавлено. ID = ' . $id);
                response()->redirect('/admin/buildings/');
            } else {
                $this->rememberFormErrors($model, 'Ошибка добавления здания');
            }
        }
        response()->redirect('/admin/buildings/create');
    }

    public function edit($id)
    {
        $model = new BuildingModel();
        $building = $model->getBuilding($id);
        return view('admin/buildings/edit', ['title' => 'Редактировать здание', 'building' => $building], 'admin');
    }

    public function update($id)
    {
        $model = new BuildingModel();
        $model->loadData();

        $res = $model->update($id);

        if ($res === false) {
            $this->rememberFormErrors($model);
            response()->redirect('/admin/buildings/edit/' . $id);
        } elseif ($res === 0) {
            session()->setFlash('info', 'Данные не изменены');
            response()->redirect('/admin/buildings/edit/' . $id);
        } else {
            session()->setFlash('success', 'Здание успешно обновлено');
            response()->redirect('/admin/buildings/');
        }

        cacheRedis()->delete('buildings');
    }

    public function delete($id)
    {
        $model = new BuildingModel();
        $model->loadData();
        if ($model->delete($id)) {
            session()->setFlash('success', 'Здание успешно удалено');
            cacheRedis()->delete('buildings');
        } else {
            session()->setFlash('error', 'Произошла ошибка при удалении здания');
        }
        response()->redirect('/admin/buildings/');
    }

    public function getBuildings()
    {
        $model = new BuildingModel();
        return $model->getBuildings();
    }
}
