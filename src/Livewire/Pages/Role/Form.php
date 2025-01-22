<?php

namespace Agenciafmd\Admix\Livewire\Pages\Role;

use Agenciafmd\Admix\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public Role $role;

    #[Validate]
    public bool $is_active = true;

    #[Validate]
    public string $name = '';

    #[Validate]
    public array $rules = [];

    public function setModel(Role $role): void
    {
        $this->role = $role;
        if ($role->exists) {
            $this->is_active = $role->is_active;
            $this->name = $role->name;
            $this->rules = $role->rules;
        }
    }

    public function rules(): array
    {
        return [
            'is_active' => [
                'boolean',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'rules' => [
                'array',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('admix::fields.is_active'),
            'name' => __('admix::fields.name'),
            'rules' => __('admix::fields.rules'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());

        $this->role->fill($this->except('role'));

        return $this->role->save();
    }
}
