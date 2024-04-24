<?php

namespace Agenciafmd\Admix\Livewire\Pages\Role;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Admix\Models\Role;

class Index extends BaseIndex
{
    protected $model = Role::class;

    protected string $indexRoute = 'admix.roles.index';

    protected string $trashRoute = 'admix.roles.trash';

    protected string $creteRoute = 'admix.roles.create';

    protected string $editRoute = 'admix.roles.edit';

    public function configure(): void
    {
        $this->packageName = __(config('admix.role.name'));

        parent::configure();
    }
}
