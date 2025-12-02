<?

namespace App\Controllers;

use Youpi\Controller;
use App\Models\BuildingModel;

class BuildingController extends Controller
{
    public function list()
    {

        return view('admin/buildings', ['title' => "Buildings Page", 'buildings' => $this->getBuildings()], 'admin');
    }

    public function create()
    {
        return view('admin/buildings/create', ['title' => "Create Buildings Page"], 'admin');
    }

    public function store()
    {
        $model = new BuildingModel();
        $model->loadData();

        if (!$model->validate()) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            $model->attributes['created_at'] = date('Y-m-d H:i:s');
            if ($id = $model->save()) {
                session()->setFlash('success', 'Здание успешно добавлено. ID = ' . $id);
                response()->redirect('/admin/buildings/');
            } else {
                session()->setFlash('error', 'Ошибка добавления здания');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/buildings/create');
    }

    public function edit($id)
    {
        $model = new BuildingModel();
        $building = $model->getBuilding($id);
        return view('admin/buildings/edit', ['title' => "Edit Buildings Page", 'building' => $building], 'admin');
    }

    public function update($id)
    {
        $model = new BuildingModel();
        $model->loadData();

        // $currentBuilding = $model->getBuilding($id);

        // TODO UPDATE


        if (db()->findOne('buildings', $model->attributes['name'], 'name') !== null) {
            session()->setFlash('error', 'Не заполнены обязательные поля');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            $model->attributes['updated_at'] = date('Y-m-d H:i:s');
            if ($model->update()) {
                session()->setFlash('success', 'Здание' . $model->attributes['name'] . 'успешно обновлено');
                response()->redirect('/admin/buildings/');
            } else {
                session()->setFlash('error', 'Ошибка обновления здания');
                session()->set('form_errors', $model->getErrors());
                session()->set('form_data', $model->attributes);
            }
        }
        response()->redirect('/admin/buildings/edit/' . $id);
    }

    public function getBuildings()
    {
        if (!$buildings = cacheRedis()->isSet('buildings')) {
            $model = new BuildingModel();
            $buildings = $model->getBuildings();
            cacheRedis()->set('buildings', $buildings);
        }
        return cacheRedis()->get('buildings');
    }
}
