<?php

namespace Agenciafmd\Admix\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Logout extends Component
{
    public function mount(): Redirector|RedirectResponse
    {
        Auth::guard('admix-web')
            ->logout();

        return redirect()->to(route('admix.auth.login'));
    }
}