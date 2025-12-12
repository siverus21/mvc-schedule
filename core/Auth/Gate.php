<?php

namespace Youpi\Auth;

class Gate
{
    protected static array $definitions = [];
    protected static array $policies = [];

    public static function define(string $ability, callable $callback): void
    {
        self::$definitions[$ability] = $callback;
    }

    public static function policy(string $modelClass, string $policyClass): void
    {
        self::$policies[$modelClass] = new $policyClass;
    }

    /**
     * Проверка: имеет ли пользователь ability для ресурса.
     * $user можно передать (массив), но по умолчанию берём Youpi\Auth::user()
     */
    public static function allows(string $ability, $resource = null, $user = null): bool
    {
        if ($user === null) {
            $user = \Youpi\Auth::user();
        }

        if (!$user) {
            return false;
        }

        if (isset(self::$definitions[$ability])) {
            return (bool) call_user_func(self::$definitions[$ability], $user, $resource);
        }

        if (is_object($resource)) {
            $class = get_class($resource);
            if (isset(self::$policies[$class])) {
                $policy = self::$policies[$class];
                if (method_exists($policy, $ability)) {
                    return (bool) $policy->{$ability}($user, $resource);
                }
            }
        }

        return false;
    }
}
