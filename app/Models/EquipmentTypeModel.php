<?

namespace App\Models;

use Youpi\Model;

class EquipmentTypeModel extends Model
{
    protected string $table = 'equipment_types';

    public bool $timestamp = false;

    protected array $loaded = ["code", "name", "description"];
    protected array $fillable = ['code', 'name', 'description'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "equipment_types,code"]],
    ];

    public function getEquipmentTypes()
    {
        return db()->query("SELECT id, code, name, description FROM $this->table")->getAssoc();
    }

    public function getEquipmentType($id)
    {
        return db()->findOrFail('equipment_types', $id);
    }
}
