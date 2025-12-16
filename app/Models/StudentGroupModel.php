<?

namespace App\Models;

use Youpi\Model;

class StudentGroupModel extends Model
{
    protected string $table = 'student_groups';
    public bool $timestamp = true;

    protected array $loaded = ["code", "name", 'program', "notes"];
    protected array $fillable = ["code", "name", 'program', "notes"];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "student_groups,code"]],
    ];

    public function getStudentGroups()
    {
        return db()->query("SELECT id, code, name, program, notes FROM $this->table")->getAssoc();
    }

    public function getStudentGroup($id)
    {
        return db()->findOrFail('student_groups', $id);
    }
}
