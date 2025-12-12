<?

namespace Youpi;

use App\Models\RoleModel;

class Auth
{

    protected static $user = null;

    public static function setUser(): void
    {
        $user = session()->get('user');
        self::$user = $user ?: null;
    }

    public static function user()
    {
        return self::$user;
    }

    public static function id()
    {
        return self::$user['id'] ?? null;
    }

    public static function roleCode()
    {
        return self::$user['role']['code'] ?? null;
    }

    public static function login(array $credentials): bool
    {
        $password = $credentials['password'];
        unset($credentials['password']);

        $field = array_key_first($credentials);
        $value = $credentials[$field];

        $user = db()->findOne('users', $value, $field);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        $roleModel = new RoleModel();
        $role = $roleModel->getRoleUser($user['id']);

        session()->set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $role,
        ]);

        return true;
    }

    // public static function user()
    // {
    //     return session()->get('user');
    // }

    public static function isAuth(): bool
    {
        return session()->isSet('user');
    }

    public static function logout(): void
    {
        session()->delete('user');
        response()->redirect(base_url('/login'));
    }

    // public static function setUser(): void
    // {
    //     if ($userData = self::user()) {
    //         $user = db()->findOne('users', $userData['id']);
    //         if ($user) {
    //             $roleModel = new RoleModel();
    //             $role = $roleModel->getRoleUser($user['id']);
    //             session()->set('user', [
    //                 'id' => $user['id'],
    //                 'name' => $user['name'],
    //                 'email' => $user['email'],
    //                 'role' => $role,
    //             ]);
    //         }
    //     }
    // }

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
