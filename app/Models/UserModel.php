<?

namespace App\Models;

use Youpi\Model;

class UserModel extends Model
{
    // Название таблицы
    protected string $table = "users";

    // Добавление created_at и updated_at
    public bool $timestamp = true;

    // Выбор отправляемых полей в бд
    protected array $fillable = ['name', 'display_name', 'email', 'password', 'role_id', 'phone', 'is_active'];

    // Загружаемые поля
    protected array $loaded = ['name', 'display_name', 'email', 'password', 'role_id', 'confirm-password', 'phone', 'is_active'];

    // Правила валидации
    public array $rules = [
        'required' => ['name', 'display_name', 'email', 'password', 'role_id', 'confirm-password'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6]
        ],
        'equals' => [
            ['password', 'confirm-password']
        ],
        'unique' => [
            ['email', 'users,email']
        ],
    ];

    // Переводы для валидации
    protected array $labels = [
        "name" => "Имя",
        "email" => "Email",
        "password" => "Пароль",
        "confirm-password" => "Подтверждение пароля"
    ];

    public function getAllUsers()
    {
        return db()->query("
        SELECT 
            u.id,
            u.email,
            u.display_name,
            u.phone,
            u.role_id,
            u.is_active,
            
            r.name        AS role_name

        FROM users AS u
        JOIN roles AS r
        ON u.role_id = r.id
        ")->get();
    }

    public function getUser($id)
    {
        return db()->findOrFail('users', $id);
    }

    public function getUsersTeacherButNoInTableTeacher()
    {
        return db()->query("
            SELECT 
                u.id,
                u.display_name,
                r.name AS role_name
            FROM users AS u
            JOIN roles AS r
                ON u.role_id = r.id
            LEFT JOIN teachers AS t
                ON u.id = t.user_id
            WHERE u.role_id = 3
            AND t.user_id IS NULL
        ")->get();
    }
}
