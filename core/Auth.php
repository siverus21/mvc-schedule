<?

namespace Youpi;

class Auth
{
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

        session()->set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ]);

        return true;
    }

    public static function user()
    {
        return session()->get('user');
    }

    public static function isAuth(): bool
    {
        return session()->isSet('user');
    }

    public static function logout(): void
    {
        session()->delete('user');
        response()->redirect(base_url('/login'));
    }

    public static function setUser(): void
    {
        if ($userData = self::user()) {
            $user = db()->findOne('users', $userData['id']);
            if ($user) {
                session()->set('user', [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ]);
            }
        }
    }
}
