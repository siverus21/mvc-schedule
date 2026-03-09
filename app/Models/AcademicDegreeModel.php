<?

namespace App\Models;

class AcademicDegreeModel extends BaseModel
{
    protected string $table = 'academic_degrees';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name', 'notes'];
    protected array $fillable = ['code', 'name', 'notes'];
    protected array $listColumns = ['id', 'code', 'name', 'notes'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'academic_degrees,code']],
    ];

    public function getAllAcademicDegrees(): array
    {
        return $this->getAllRecords();
    }

    public function getAcademicDegree(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
