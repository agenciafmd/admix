<?php

namespace Agenciafmd\Admix\Services;

use Agenciafmd\Admix\User;

class UserService
{
    public function all()
    {
        return User::withTrashed()->get();
    }

    public function toSelect()
    {
        $users = $this->all();
        $values = [];
        foreach ($users as $user) {
            $values[$user->id] = $user->name . " ({$user->email})";
        }

        return $values;
    }
}
