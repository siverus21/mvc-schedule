<?php

namespace Youpi\Policies;

class UserPolicy
{
    public function edit($current, $target): bool
    {
        $currentRole = $current['role']['code'] ?? null;
        if ($currentRole === 'admin') {
            return true;
        }

        $targetId = is_array($target) ? ($target['id'] ?? null) : ($target->id ?? null);
        return $current['id'] === $targetId;
    }

    public function view($current, $target): bool
    {
        return $this->edit($current, $target);
    }
}
