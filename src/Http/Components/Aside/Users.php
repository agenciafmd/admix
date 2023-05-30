<?php

namespace Agenciafmd\Admix\Http\Components\Aside;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class Users extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public bool   $active = false,
        public bool   $visible = false,
        public array  $children = [],
    ) {}

    public function render(): View
    {
        $this->icon = 'users';
        $this->label = __('Users');
        $this->active = Str::of(request()->route()->getName())->startsWith(['admix.users', 'admix.roles']);
        $this->visible = true;
        $this->children = [
            [
                'label' => __('Users'),
                'url' => route('admix.user.index'),
                'active' => (Str::startsWith(request()->route()->getName(), 'admix.users')),
                'visible' => true,
            ],
            [
                'label' => __('Roles'),
                'url' => '', // route('admix.roles.index'),
                'active' => (Str::startsWith(request()->route()->getName(), 'admix.roles')),
                'visible' => true,
            ]
        ];

        return view('admix::components.aside.dropdown');
    }
}