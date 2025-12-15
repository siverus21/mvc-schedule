<?

namespace App\Models;

use Youpi\Model;

class AcademicDegreeModel extends Model
{
    protected string $table = 'academic_degrees';
    public bool $timestamp = true;

    protected array $loaded = ["code", "name", "notes"];
    protected array $fillable = ['code', 'name', "notes"];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "academic_degrees,code"]],
    ];

    public function getAllAcademicDegrees(): array
    {
        return db()->query("SELECT id, code, name, notes FROM $this->table")->getAssoc();
    }

    public function getAcademicDegree($id): array
    {
        return db()->findOrFail('academic_degrees', $id);
    }
}
