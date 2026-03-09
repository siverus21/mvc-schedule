<?

namespace App\Models;

class SemesterModel extends BaseModel
{
    protected string $table = 'semesters';
    public bool $timestamp = true;

    protected array $loaded = ['name'];
    protected array $fillable = ['name'];

    public array $rules = [
        'required' => ['name'],
        'unique'   => [['name', 'semesters,name']],
    ];

    public function getSemesters(): array
    {
        return $this->getAllRecords();
    }

    public function getSemester(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
