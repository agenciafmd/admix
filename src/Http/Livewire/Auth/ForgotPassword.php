<?php

namespace Agenciafmd\Admix\Http\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\Redirector;

class ForgotPassword extends Component
{
    public string $email;

//    public function route()
//    {
//        return Route::get('/login', static::class)
//            ->name('login')
//            ->middleware('guest');
//    }

    public function render(): View
    {
        return view('admix::auth.forgot-password')
            ->extends('admix::master', [
                'bodyClass' => 'd-flex flex-column',
                'pageClass' => 'page page-center',
            ]);
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:rfc,dns',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('admix::fields.email'),
        ];
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        $response = Password::broker('admix-users')
            ->sendResetLink([
                'email' => $data['email'],
            ]);

        if ($response === Password::RESET_LINK_SENT) {
            $this->email = '';
            $this->emit('toast', [
                'level' => 'success',
                'message' => __('passwords.sent'),
            ]);

            return null;
        }

        $this->addError('email', __('passwords.user'));

        return null;
    }
}
