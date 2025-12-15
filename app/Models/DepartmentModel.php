<?

namespace App\Models;

use Youpi\Model;

class DepartmentModel extends Model
{
    protected string $table = 'department';

    public bool $timestamp = true;

    protected array $loaded = ["code", "name", "notes"];
    protected array $fillable = ['code', 'name', 'notes'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "equipment_types,code"]],
    ];

    public function getAllDepartments()
    {
        return db()->query("SELECT id, code, name, notes FROM $this->table")->getAssoc();
    }

    public function getDepartment($id)
    {
        return db()->findOrFail($this->table, $id);
    }
}
