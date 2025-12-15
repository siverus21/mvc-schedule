<?

namespace App\Models;

use Youpi\Model;

class TeacherModel extends Model
{
    protected string $table = 'teachers';
    public bool $timestamp = true;

    protected array $loaded = ['user_id', 'department_id', 'staff_number', 'academic_degree_id'];
    protected array $fillable = ['user_id', 'department_id', 'staff_number', 'academic_degree_id'];

    public array $rules = [
        'required' => ['user_id', 'department_id', 'academic_degree_id'],
        'unique' => [['user_id', "teachers,user_id"]],
    ];

    public function getAllTeachers(): array
    {
        return db()->query("
        SELECT
            t.id,
            t.user_id,
            t.department_id,
            t.staff_number,
            t.academic_degree_id,
            u.name as name,
            u.email as email,
            d.name as department,
            ad.name as academic_degree

            FROM teachers t
            LEFT JOIN users u ON t.user_id = u.id
            LEFT JOIN department d ON t.department_id = d.id
            LEFT JOIN academic_degrees ad ON t.academic_degree_id = ad.id
        ")->getAssoc();
    }

    public function getTeacher($id): array
    {
        return db()->findOrFail($this->table, $id);
    }
}
