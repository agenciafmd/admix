<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public function mount(): void
    {
        //
    }

    public function render(): View
    {
        return view('admix::pages.user.index')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
