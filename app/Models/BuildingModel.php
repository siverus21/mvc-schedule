<?

namespace App\Models;

use Youpi\Model;

class BuildingModel extends Model
{
    protected string $table = 'buildings';

    public bool $timestamp = false;

    protected array $loaded = ["code", "name", "address"];
    protected array $fillable = ['code', 'name', 'address', 'created_at'];

    public array $rules = [
        'required' => ['name', 'address'],
        'unique' => [['name', "buildings,name"]],
    ];

    public function getBuildings()
    {
        return db()->query("SELECT id, name, address FROM $this->table")->getAssoc();
    }

    public function getBuilding($id)
    {
        return db()->findOrFail('buildings', $id);
    }
}
