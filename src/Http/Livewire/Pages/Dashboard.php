<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        return view('admix::pages.dashboard')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
