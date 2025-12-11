<?php

namespace core\Middleware;

class Role
{
    public function handle($request, $next, ...$params)
    {
        // $params может быть ['admin'] или ['admin,teacher']
        $user = $request->user();

        if (!$user) {
            http_response_code(401);
            echo "Unauthorized";
            exit;
        }

        $roles = [];
        foreach ($params as $p) {
            $parts = array_map('trim', explode(',', $p));
            $roles = array_merge($roles, $parts);
        }

        if ($user->hasAnyRole($roles)) {
            return $next($request);
        }

        http_response_code(403);
        echo "Forbidden";
        exit;
    }
}
