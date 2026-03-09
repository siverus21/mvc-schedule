<?

namespace App\Models;

class SubjectModel extends BaseModel
{
    protected string $table = 'subjects';
    public bool $timestamp = true;

    protected array $loaded = ['name', 'code', 'description'];
    protected array $fillable = ['name', 'code', 'description'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'subjects,code']],
    ];

    public function getAllSubjects(): array
    {
        return $this->getAllRecords();
    }

    public function getSubject(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
