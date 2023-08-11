<?php

namespace Agenciafmd\Admix\Policies;

use Agenciafmd\Admix\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmixPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin) {
            return true;
        }

        if ($user->hasAbility(static::class . '@' . $ability)) {
            return true;
        }

        return null;
    }

    public function view(User $user): bool
    {
        return false;
    }

    public function edit(User $user): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(User $user): bool
    {
        return false;
    }

    public function restore(User $user): bool
    {
        return false;
    }
}
