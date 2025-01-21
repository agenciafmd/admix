<?php

namespace Agenciafmd\Admix\Http\Components\Aside;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public string $url = '',
        public bool $active = false,
        public bool $visible = false,
    ) {}

    public function render(): View
    {
        $this->icon = 'activity';
        $this->label = 'Dashboard';
        $this->url = route('admix.dashboard');
        $this->active = request()?->currentRouteNameStartsWith('admix.dashboard');
        $this->visible = true;

        return view('admix::components.aside.item');
    }
}
