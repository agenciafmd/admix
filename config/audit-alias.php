<?php

use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;

return [
    User::class => config('admix.user.name') . ' » ' . config('admix.user.name'),
    Role::class => config('admix.user.name') . ' » ' . config('admix.role.name'),
];
