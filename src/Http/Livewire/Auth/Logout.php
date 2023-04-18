<?php

namespace Agenciafmd\Admix\Http\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;

class Logout extends Component
{
//    public function route()
//    {
//        return Route::get('/login', static::class)
//            ->name('login')
//            ->middleware('guest');
//    }

    public function mount(): Redirector|RedirectResponse
    {
        Auth::guard('admix-web')->logout();

        return redirect()->to(route('admix.auth.login'));
    }
}