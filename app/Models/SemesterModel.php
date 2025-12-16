<?

namespace App\Models;

use Youpi\Model;

class SemesterModel extends Model
{
    protected string $table = 'semesters';
    public bool $timestamp = true;

    protected array $loaded = ["name"];
    protected array $fillable = ['name'];

    public array $rules = [
        'required' => ['name'],
        'unique' => [['name', "semesters,name"]],
    ];

    public function getSemesters()
    {
        return db()->query("SELECT id, name FROM $this->table")->getAssoc();
    }

    public function getSemester($id)
    {
        return db()->findOrFail('semesters', $id);
    }
}
