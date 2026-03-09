<?

namespace App\Models;

class LessonTypeModel extends BaseModel
{
    protected string $table = 'lesson_types';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name'];
    protected array $fillable = ['code', 'name'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'lesson_types,code']],
    ];

    public function getLessonTypes(): array
    {
        return $this->getAllRecords();
    }

    public function getLessonType(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
