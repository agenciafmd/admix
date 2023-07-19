<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Role;

use Agenciafmd\Admix\Http\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Admix\Models\Role;

class Index extends BaseIndex
{
    protected $model = Role::class;
    protected string $indexRoute = 'admix.role.index';
    protected string $trashRoute = 'admix.role.trash';
    protected string $creteRoute = 'admix.role.create';
    protected string $editRoute = 'admix.role.edit';

    public function configure(): void
    {
        $this->packageName = __(config('admix.role.name'));

        parent::configure();
    }
}