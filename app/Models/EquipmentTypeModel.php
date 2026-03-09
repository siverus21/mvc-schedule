<?

namespace App\Models;

class EquipmentTypeModel extends BaseModel
{
    protected string $table = 'equipment_types';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name', 'description'];
    protected array $fillable = ['code', 'name', 'description'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'equipment_types,code']],
    ];

    public function getEquipmentTypes(): array
    {
        return $this->getAllRecords();
    }

    public function getEquipmentType(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
