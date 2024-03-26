<?php

namespace Agenciafmd\Admix\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class _MyAccount extends Component
{
    public User $model;

    public function mount(): void
    {
        $this->model = Auth::guard('admix-web')
            ->user();
    }

    public function rules(): array
    {
        return array_merge([
            'model.name' => [
                'required',
                'max:255',
            ],
            'model.email' => [
                'required',
                Rule::unique('users', 'email')
                    ->where(fn (Builder $query) => $query->where('users.type', $this->model->type))
                    ->ignore($this->model->id ?? null),
                'email:rfc,dns',
                'max:255',
            ],
            'model.can_notify' => [
                'boolean',
            ],
        ], $this->model->loadMappedMediaRules($this->media));
    }

    public function attributes(): array
    {
        return [
            'email' => __('admix::fields.email'),
            'password' => __('admix::fields.password'),
            'can_notify' => __('admix::fields.can_notify'),
            'media.avatar' => __('admix::fields.media.avatar'),
        ];
    }

    public function updated(mixed $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function render(): View
    {
        return view('admix::pages.profile.my-account')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        try {
            if ($this->model->save()) {
                $this->dispatch(event: 'toast', level: 'success', message: __('crud.success.save'));
            } else {
                $this->dispatch(event: 'toast', level: 'error', message: __('crud.error.update'));
            }
        } catch (\Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }
}
