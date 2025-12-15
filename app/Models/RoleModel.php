<?

namespace App\Models;

use Youpi\Auth;
use Youpi\Model;

class RoleModel extends Model
{
    protected string $table = 'roles';

    public bool $timestamp = true;

    protected array $fillable = ['code', 'name', 'description'];

    protected array $loaded = ["code", "name", "description"];

    // Правила валидации
    protected array $rules = [
        'required' => ['code', 'name'],
        'unique' => [
            ['code', 'roles,code']
        ],
    ];

    public function getAllRoles()
    {
        return db()->query("SELECT id, code, name FROM $this->table")->getAssoc();
    }

    public function getRoleUser($userId)
    {
        $role = db()->query("
        SELECT 
            roles.id,
            roles.code,
            roles.name
        FROM users
        LEFT JOIN roles ON users.role_id = roles.id
        WHERE users.id = {$userId}
        ")->get();

        return $role[0];
    }

    public function hasRole($needCodeRole): bool
    {
        $user = \Youpi\Auth::user();
        if (!$user || !isset($user['role']['code'])) {
            return false;
        }

        $current = $user['role']['code'];

        if (is_array($needCodeRole)) {
            return in_array($current, $needCodeRole, true);
        }

        if (is_string($needCodeRole) && strpos($needCodeRole, ',') !== false) {
            $parts = array_map('trim', explode(',', $needCodeRole));
            return in_array($current, $parts, true);
        }

        return $current === (string)$needCodeRole;
    }
}
