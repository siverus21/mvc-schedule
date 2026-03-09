<?

namespace App\Models;

class StudentGroupModel extends BaseModel
{
    protected string $table = 'student_groups';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name', 'program', 'notes'];
    protected array $fillable = ['code', 'name', 'program', 'notes'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'student_groups,code']],
    ];

    public function getStudentGroups(): array
    {
        return $this->getAllRecords();
    }

    public function getStudentGroup(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
