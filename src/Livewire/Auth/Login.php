<?php

namespace Agenciafmd\Admix\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Login extends Component
{
    public string $email;
    public string $password;
    public bool $remember = false;

    public function render(): View
    {
        return view('admix::auth.login')
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
            'password' => [
                'required',
            ],
            'remember' => [
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('admix::fields.email'),
            'password' => __('admix::fields.password'),
            'remember' => __('admix::fields.remember'),
        ];
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        $throttleKey = Str::of($data['email'])
                ->lower() . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey),
            ]));

            return null;
        }

        if (!Auth::guard('admix-web')
            ->attempt([
                'email' => $data['email'],
                'password' => $data['password'],
                'is_active' => true,
            ], $data['remember'] ?? false)) {
            RateLimiter::hit($throttleKey);

            $this->addError('email', __('auth.failed'));

            return null;
        }

        return redirect()->intended(route('admix.dashboard'));
    }
}
