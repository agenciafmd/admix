<?php

namespace Agenciafmd\Admix\Http\Components\Aside;

use Agenciafmd\Admix\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Gate;
use Agenciafmd\Admix\Models\User;

class Users extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public bool $active = false,
        public bool $visible = false,
        public array $children = [],
    ) {}

    public function render(): View
    {
        $this->icon = config('admix.user.icon');
        $this->label = __(config('admix.user.name'));
        $this->active = request()?->currentRouteNameStartsWith(['admix.user', 'admix.role']);
        $this->visible = (Gate::allows('view',User::class) || Gate::allows('view',Role::class)) ? true : false;
        $this->children = [
            [
                'label' => __(config('admix.user.name')),
                'url' => route('admix.users.index'),
                'active' => request()?->currentRouteNameStartsWith('admix.user'),
                'visible' => Gate::allows('view',User::class),
            ],
            [
                'label' => __(config('admix.role.name')),
                'url' => route('admix.roles.index'),
                'active' => request()?->currentRouteNameStartsWith('admix.role'),
                'visible' => Gate::allows('view',Role::class),
            ],
        ];

        return view('admix::components.aside.dropdown');
    }
}
