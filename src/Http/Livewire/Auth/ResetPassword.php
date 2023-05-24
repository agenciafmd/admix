<?php

namespace Agenciafmd\Admix\Http\Livewire\Auth;

use Agenciafmd\Admix\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class ResetPassword extends Component
{
    public string $token;

    public string $email;

    public string $password;

    public string $password_confirmation;

//    public function route()
//    {
//        return Route::get('/login', static::class)
//            ->name('login')
//            ->middleware('guest');
//    }

    public function mount(string $token): void
    {
        $this->token = $token;
    }

    public function render(): View
    {
        return view('admix::auth.reset-password')
            ->extends('admix::master', [
                'bodyClass' => 'd-flex flex-column',
                'pageClass' => 'page page-center',
            ]);
    }

    public function updated(string $field): void
    {
//        $this->validateOnly($field, $this->rules(), [], $this->attributes());
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
                'min:6',
                'confirmed'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('admix::fields.email'),
            'password' => __('admix::fields.password'),
        ];
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        $status = Password::broker('admix-users')
            ->reset([
                'email' => $data['email'],
                'password' => $data['password'],
                'token' => $this->token,
            ], function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])
                    ->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            });

        if ($status === Password::PASSWORD_RESET) {
            flash(__($status), 'success');

            return redirect()->route('admix.auth.login');
        }

        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';

        $this->addError('email', __($status));

        return null;
    }
}
