<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Http\Livewire\Auth\ForgotPassword;
use Agenciafmd\Admix\Http\Livewire\Auth\Login;
use Agenciafmd\Admix\Http\Livewire\Auth\ResetPassword;
use Agenciafmd\Admix\Http\Livewire\Dashboard;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.admix.http.livewire.auth.login', Login::class);
        Livewire::component('agenciafmd.admix.http.livewire.auth.forgot-password', ForgotPassword::class);
        Livewire::component('agenciafmd.admix.http.livewire.auth.reset-password', ResetPassword::class);
        Livewire::component('agenciafmd.admix.http.livewire.dashboard', Dashboard::class);
    }

    public function register(): void
    {
        //
    }
}
