<?

namespace App\Models;

use Youpi\Model;

class SubjectModel extends Model
{
    protected string $table = 'subjects';
    public bool $timestamp = true;

    protected array $loaded = ["name", "code", "description"];
    protected array $fillable = ["name", "code", "description"];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "subjects,code"]],
    ];

    public function getAllSubjects()
    {
        return db()->query("SELECT id, code, name, description FROM $this->table")->getAssoc();
    }

    public function getSubject($id)
    {
        return db()->findOrFail('subjects', $id);
    }
}
