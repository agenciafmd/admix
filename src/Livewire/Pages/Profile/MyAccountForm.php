<?php

namespace Agenciafmd\Admix\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MyAccountForm extends Form
{
    public User $user;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $email = '';

    #[Validate]
    public bool $can_notify = false;

    public function setModel(User $user): void
    {
        $this->user = $user;
        if ($user->exists) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->can_notify = $user->can_notify;
        }
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')
                    ->where(fn (Builder $builder) => $builder->where('type', $this->user->type))
                    ->ignore($this->user->id ?? null),
                'email:rfc,dns',
                'max:255',
            ],
            'can_notify' => [
                'boolean',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => __('admix::fields.name'),
            'email' => __('admix::fields.email'),
            'can_notify' => __('admix::fields.can_notify'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());

        $this->user->fill($this->all());

        return $this->user->save();
    }
}
