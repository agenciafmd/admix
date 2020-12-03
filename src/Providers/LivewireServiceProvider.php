<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Http\Livewire\IsActive;
use Agenciafmd\Admix\Http\Livewire\Search;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('admix::search', Search::class);
        Livewire::component('admix::is-active', IsActive::class);
    }

    public function register()
    {
        //
    }
}
