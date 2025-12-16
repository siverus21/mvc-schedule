<?

namespace App\Models;

use Youpi\Model;

class LessonTypeModel extends Model
{
    protected string $table = 'lesson_types';
    public bool $timestamp = true;

    protected array $loaded = ["code", "name"];
    protected array $fillable = ['code', 'name'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "lesson_types,code"]],
    ];

    public function getLessonTypes()
    {
        return db()->query("SELECT id, code, name FROM $this->table")->getAssoc();
    }

    public function getLessonType($id)
    {
        return db()->findOrFail('lesson_types', $id);
    }
}
