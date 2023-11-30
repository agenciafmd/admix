<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages;

use Agenciafmd\Analytics\Providers\AnalyticsServiceProvider;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        if (class_exists(AnalyticsServiceProvider::class) && (config('analytics.site_id'))) {
            return view('admix-analytics::dashboard')
                ->extends('admix::internal')
                ->section('internal-content');
        }

        return view('admix::pages.dashboard')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
