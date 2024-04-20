<?php

namespace Agenciafmd\Admix\Http\Components\Aside;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Users extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public bool $active = false,
        public bool $visible = false,
        public array $children = [],
    ) {
    }

    public function render(): View
    {
        $this->icon = config('admix.user.icon');
        $this->label = __(config('admix.user.name'));
        $this->active = request()?->currentRouteNameStartsWith(['admix.user', 'admix.role']);
        $this->visible = true;
        $this->children = [
            [
                'label' => __(config('admix.user.name')),
                'url' => route('admix.user.index'),
                'active' => request()?->currentRouteNameStartsWith('admix.user'),
                'visible' => true,
            ],
            [
                'label' => __(config('admix.role.name')),
                'url' => route('admix.role.index'),
                'active' => request()?->currentRouteNameStartsWith('admix.role'),
                'visible' => true,
            ],
        ];

        return view('admix::components.aside.dropdown');
    }
}