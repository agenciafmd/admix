<?php

namespace Agenciafmd\Admix\Http\Components\Aside;

use Agenciafmd\Admix\Models\Audit;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Gate;

class Logs extends Component
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
        $this->icon = __(config('admix.audit.icon'));
        $this->label = __(config('admix.audit.name'));
        $this->url = route('admix.audit.index');
        $this->active = request()?->currentRouteNameStartsWith('admix.audit');
        $this->visible = Gate::allows('view',Audit::class);

        return view('admix::components.aside.item');
    }
}
