<?php

namespace core\Auth;

class Gate
{
    protected static array $definitions = [];
    protected static array $policies = [];

    public static function define(string $ability, callable $callback)
    {
        self::$definitions[$ability] = $callback;
    }

    public static function policy(string $class, string $policyClass)
    {
        self::$policies[$class] = new $policyClass;
    }

    public static function allows(string $ability, $user, $resource = null): bool
    {
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
