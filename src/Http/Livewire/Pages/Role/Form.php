<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Role;

use Agenciafmd\Admix\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class Form extends Component
{
    use AuthorizesRequests;

    public Role $role;
    public Collection $gateRules;

    public function mount(Role $role): void
    {
        ($role->id) ? $this->authorize('update', Role::class) : $this->authorize('create', Role::class);

        $this->role = $role;
        $this->role->is_active ??= false;
        $this->role->rules ??= [];
        $this->gateRules = $this->gateRules();
    }

    public function rules(): array
    {
        return [
            'role.is_active' => [
                'boolean',
            ],
            'role.name' => [
                'required',
                'max:255',
            ],
            'role.rules' => [
                'array',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'is_active' => __('admix::fields.is_active'),
            'name' => __('admix::fields.name'),
            'rules' => __('admix::fields.rules'),
        ];
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        try {
            if ($this->role->save()) {
                flash(__('crud.success.save'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.role.index'));
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
        return view('admix::pages.role.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }

    private function gateRules(): Collection
    {
        return collect(config('gate'))
            ->sortBy('sort')
            ->map(function ($group) {
                return [
                    'name' => Str::of($group['name'])
                        ->explode(' » ')
                        ->map(fn($name) => __($name))
                        ->implode(' » '),
                    'policies' => collect($group['abilities'])->map(fn($ability) => [
                        'name' => __($ability['name']),
                        'policy' => $group['policy'] . '@' . $ability['method'],
                    ]),
                ];
            })
            ->values();
    }
}
