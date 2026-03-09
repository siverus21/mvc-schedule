<?

namespace App\Models;

use Youpi\Auth;

class RoleModel extends BaseModel
{
    protected string $table = 'roles';
    public bool $timestamp = true;

    protected array $fillable = ['code', 'name', 'description'];
    protected array $loaded = ['code', 'name', 'description'];
    protected array $rules = [
        'required' => ['code', 'name'],
        'unique'   => [['code', 'roles,code']],
    ];

    public function getAllRoles(): array
    {
        return $this->getAllRecords(['id', 'code', 'name']);
    }

    public function getRoleUser($userId): ?array
    {
        $role = db()->query("
            SELECT roles.id, roles.code, roles.name
            FROM users
            LEFT JOIN roles ON users.role_id = roles.id
            WHERE users.id = " . (int) $userId . "
        ")->get();
        return $role[0] ?? null;
    }

    public function hasRole(string|array $needCodeRole): bool
    {
        $user = Auth::user();
        if (!$user || !isset($user['role']['code'])) {
            return false;
        }
        $current = $user['role']['code'];
        if (is_array($needCodeRole)) {
            return in_array($current, $needCodeRole, true);
        }
        if (is_string($needCodeRole) && str_contains($needCodeRole, ',')) {
            $parts = array_map('trim', explode(',', $needCodeRole));
            return in_array($current, $parts, true);
        }
        return $current === (string) $needCodeRole;
    }
}
