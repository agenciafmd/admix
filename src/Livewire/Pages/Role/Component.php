<?php

namespace Agenciafmd\Admix\Livewire\Pages\Role;

use Agenciafmd\Admix\Models\Role;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Livewire\Features\SupportRedirects\Redirector;

class Component extends LivewireComponent
{
    use AuthorizesRequests;

    public Form $form;

    public Role $role;

    public Collection $gateRules;

    public function mount(Role $role): void
    {
        ($role->exists) ? $this->authorize('update', Role::class) : $this->authorize('create', Role::class);

        $this->form->setModel($role);
        $this->role = $role;
        $this->gateRules = $this->gateRules();
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                flash(($this->role->exists) ? __('crud.success.save') : __('crud.success.store'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.roles.index'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
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
                    'name' => str($group['name'])
                        ->explode(' » ')
                        ->map(fn ($name) => __($name))
                        ->implode(' » '),
                    'policies' => collect($group['abilities'])->map(fn ($ability) => [
                        'name' => __($ability['name']),
                        'policy' => $group['policy'] . '@' . $ability['method'],
                    ]),
                ];
            })
            ->values();
    }
}
