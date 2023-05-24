<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Admix\Traits\WithModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Validation\Rules\Password;

class ChangePassword extends Component
{
    public $user;
    public string $password;
    public string $password_confirmation;

    public function mount()
    {
        $this->user = Auth::guard('admix-web')
            ->user();
    }

    public function render(): View
    {
        return view('admix::pages.profile.change-password')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
        ];
   }

    public function attributes(): array
    {
        return [
            'password' => __('admix::fields.new_password'),
            'password_confirmation' => __('admix::fields.password_confirmation'),
        ];
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        $this->user->update([
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('admix-web')->logout();

        flash(__('Password changed successfully!'), 'success');

        return redirect()->to(route('admix.auth.login'));
    }
}
