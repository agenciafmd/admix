<?php

namespace Agenciafmd\Admix\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ChangePasswordForm extends Form
{
    public User $user;

    #[Validate]
    public string $password = '';

    #[Validate]
    public string $password_confirmation = '';

    public function setModel(User $user): void
    {
        $this->user = $user;
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
                    ->symbols(),
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'password' => __('admix::fields.password'),
            'password_confirmation' => __('admix::fields.password_confirmation'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());

        $this->user->password = $this->password;

        return $this->user->save();
    }
}
