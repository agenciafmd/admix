<?php

namespace Agenciafmd\Admix\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Ui\Traits\WithMediaSync;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    use WithMediaSync;

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

    #[Validate]
    public array $avatar_files = [];

    #[Validate]
    public Collection $avatar;

    public function setModel(User $user): void
    {
        $this->user = $user;
        $this->avatar = collect();
        if ($user->exists) {
            $this->is_active = $user->is_active;
            $this->can_notify = $user->can_notify;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role_id = $user->role_id;
            $this->avatar = $user->avatar;
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
            'avatar_files.*' => [
                'image',
                'max:1024',
                Rule::dimensions()
                    ->maxWidth(1200)
                    ->maxHeight(1200),
            ],
            'avatar' => [
                'array',
                'required',
                'min:1',
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
            'avatar' => __('admix::fields.avatar'),
            'avatar_files.*' => __('admix::fields.avatar_files'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $data = $this->except(['user']);
        if (!$data['password']) {
            unset($data['password'], $data['password_confirmation']);
        }
        $this->user->fill($data);

        if (!$this->user->exists) {
            $this->user->save();
        }

        $this->syncMedia($this->user, 'avatar', 'avatar_files');

        return $this->user->save();
    }
}
