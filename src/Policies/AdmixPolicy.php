<?php

namespace Agenciafmd\Admix\Policies;

use Agenciafmd\Admix\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmixPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }

        // validamos a habilidade, se for encontrada, continuamos
        // caso contrario caimos no metodo da habilidade
        // que por padrão retornará false
        if ($user->hasAbility(static::class . '@' . $ability)) {
            return true;
        }
    }

    public function view(User $user)
    {
        return false;
    }

    public function edit(User $user)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user)
    {
        return false;
    }

    public function delete(User $user)
    {
        return false;
    }

    public function restore(User $user)
    {
        return false;
    }
}
