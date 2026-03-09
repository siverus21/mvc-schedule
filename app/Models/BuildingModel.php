<?

namespace App\Models;

class BuildingModel extends BaseModel
{
    protected string $table = 'buildings';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name', 'address'];
    protected array $fillable = ['code', 'name', 'address', 'created_at'];
    protected array $listColumns = ['id', 'name', 'address'];

    public array $rules = [
        'required' => ['name', 'address'],
        'unique'   => [['name', 'buildings,name']],
    ];

    public function getBuildings(): array
    {
        return $this->getAllRecords();
    }

    public function getBuilding(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
