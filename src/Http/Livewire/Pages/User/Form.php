<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class Form extends Component
{
    public User $user;
    public string $password;
    public string $password_confirmation;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->user->is_active ??= false;
        $this->user->can_notify ??= false;
    }

    public function rules(): array
    {
        $rules = [
            'user.is_active' => [
                'boolean',
            ],
            'user.can_notify' => [
                'boolean',
            ],
            'user.name' => [
                'required',
                'max:255',
            ],
            'user.email' => [
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
        ];

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'is_active' => __('admix::fields.is_active'),
            'email' => __('admix::fields.email'),
            'password' => __('admix::fields.password'),
            'can_notify' => __('admix::fields.can_notify'),
            'media.avatar' => __('admix::fields.media.avatar'),
        ];
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        if ($data['password']) {
            $this->user->password = Hash::make($data['password']);
        }

        try {
            if ($this->user->save()) {
                flash(__('crud.success.save'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.user.index'));
        } catch (\Exception $e) {
            $this->emit('toast', [
                'level' => 'danger',
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function render(): View
    {
        return view('admix::pages.user.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
