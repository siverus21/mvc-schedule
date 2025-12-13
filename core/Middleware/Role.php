<?php

namespace Youpi\Middleware;

class Role
{
    public function handle(array $needRole)
    {
        $role = getUserRole();
        if (!$role) {
            abort(404);
        }

        if (!in_array($role, $needRole)) {
            session()->setFlash('error', 'Forbidden');
            response()->redirect(base_url('/admin/dashboard'));
        }
    }
}
