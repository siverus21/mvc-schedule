<?

namespace App\Models;

use Youpi\Model;

class UserModel extends Model
{
    protected string $table = "users";

    public bool $timestamp = true;

    protected array $fillable = ['name', 'email', 'password'];

    protected array $loaded = ["name", "email", "password", "confirm-password"];

    protected array $rules = [
        'required' => ['name', 'email', 'password', 'confirm-password'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6]
        ],
        'equals' => [
            ['password', 'confirm-password']
        ]
    ];

    protected array $labels = [
        "name" => "Имя",
        "email" => "Email",
        "password" => "Пароль",
        "confirm-password" => "Подтверждение пароля"
    ];
}
