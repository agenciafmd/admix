<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Livewire\Auth;
use Agenciafmd\Admix\Livewire\Pages;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.admix.livewire.auth.login', Auth\Login::class);
        Livewire::component('agenciafmd.admix.livewire.auth.forgot-password', Auth\ForgotPassword::class);
        Livewire::component('agenciafmd.admix.livewire.auth.reset-password', Auth\ResetPassword::class);
        Livewire::component('agenciafmd.admix.livewire.pages.dashboard', Pages\Dashboard::class);
        Livewire::component('agenciafmd.admix.livewire.pages.profile.my-account', Pages\Profile\MyAccount::class);
        Livewire::component('agenciafmd.admix.livewire.pages.profile.change-password',
            Pages\Profile\ChangePassword::class);
//        Livewire::component('agenciafmd.admix.http.livewire.pages.user.index', Pages\User\Index::class);
//        Livewire::component('agenciafmd.admix.http.livewire.pages.user.form', Pages\User\Form::class);
        Livewire::component('agenciafmd.admix.livewire.pages.role.index', Pages\Role\Index::class);
        Livewire::component('agenciafmd.admix.livewire.pages.role.component', Pages\Role\Component::class);
        Livewire::component('agenciafmd.admix.livewire.pages.audit.index', Pages\Audit\Index::class);
    }

    public function register(): void
    {
        //
    }
}
