<?

namespace App\Models;

class DepartmentModel extends BaseModel
{
    protected string $table = 'department';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name', 'notes'];
    protected array $fillable = ['code', 'name', 'notes'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'department,code']],
    ];

    public function getAllDepartments(): array
    {
        return $this->getAllRecords();
    }

    public function getDepartment(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
