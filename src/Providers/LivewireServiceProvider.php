<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Http\Livewire\Auth\ForgotPassword;
use Agenciafmd\Admix\Http\Livewire\Auth\Login;
use Agenciafmd\Admix\Http\Livewire\Auth\ResetPassword;
use Agenciafmd\Admix\Http\Livewire\Pages\Dashboard;
use Agenciafmd\Admix\Http\Livewire\Pages\Profile\MyAccount;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Agenciafmd\Admix\Http\Livewire\Pages\Profile\ChangePassword;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.admix.http.livewire.auth.login', Login::class);
        Livewire::component('agenciafmd.admix.http.livewire.auth.forgot-password', ForgotPassword::class);
        Livewire::component('agenciafmd.admix.http.livewire.auth.reset-password', ResetPassword::class);
        Livewire::component('agenciafmd.admix.http.livewire.pages.dashboard', Dashboard::class);
        Livewire::component('agenciafmd.admix.http.livewire.pages.profile.my-account', MyAccount::class);
        Livewire::component('agenciafmd.admix.http.livewire.pages.profile.change-password', ChangePassword::class);
    }

    public function register(): void
    {
        //
    }
}
