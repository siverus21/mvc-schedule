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
    protected array $fillable = ['name', 'email', 'password'];

    // Загружаемые поля
    protected array $loaded = ["name", "email", "password", "confirm-password"];

    // Правила валидации
    protected array $rules = [
        'required' => ['name', 'email', 'password', 'confirm-password'],
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
}
