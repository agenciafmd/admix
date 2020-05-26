<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Http\Livewire\Search;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('admix::search', Search::class);
    }

    public function register()
    {
        //
    }
}
