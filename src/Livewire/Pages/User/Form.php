<?php

namespace Agenciafmd\Admix\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public User $user;

    #[Validate]
    public bool $is_active = true;

    #[Validate]
    public bool $can_notify = true;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $email = '';

    #[Validate]
    public ?string $password = '';

    #[Validate]
    public ?string $password_confirmation = '';

    #[Validate]
    public ?int $role_id = null;

    public function setModel(User $user): void
    {
        $this->user = $user;
        if ($user->exists) {
            $this->is_active = $user->is_active;
            $this->can_notify = $user->can_notify;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role_id = $user->role_id;
        }
    }

    public function rules(): array
    {
        return [
            'is_active' => [
                'boolean',
            ],
            'can_notify' => [
                'boolean',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')
                    ->where(fn(Builder $query) => $query->where('type', $this->user->type))
                    ->ignore($this->user->id ?? null),
                'email:rfc,dns',
                'max:255',
            ],
            'password' => [
                'nullable',
                Rule::requiredIf(!$this->user->id),
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
                'confirmed',
            ],
            'role_id' => [
                'nullable',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('admix::fields.is_active'),
            'name' => __('admix::fields.name'),
            'email' => __('admix::fields.email'),
            'password' => __('admix::fields.password'),
            'can_notify' => __('admix::fields.can_notify'),
            'role_id' => __('admix::fields.role_id'),
//            'media.avatar' => __('admix::fields.media.avatar'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $data = $this->except('user');
        if (!$data['password']) {
            unset($data['password'], $data['password_confirmation']);
        }
        $this->user->fill($data);

        return $this->user->save();
    }
}
