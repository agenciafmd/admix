<?php

namespace Agenciafmd\Admix\Livewire\Pages\User;

use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Livewire\Features\SupportRedirects\Redirector;

class Component extends LivewireComponent
{
    use AuthorizesRequests;

    public Form $form;

    public User $user;

    public array $roleOptions;

    public function mount(User $user): void
    {
        ($user->exists) ? $this->authorize('update', User::class) : $this->authorize('create', User::class);

        $this->user = $user;
        $this->form->setModel($user);
        $this->roleOptions = $this->getRoleOptions();
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                flash(($this->user->exists) ? __('crud.success.save') : __('crud.success.store'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.users.index'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix::pages.user.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }

    private function getRoleOptions(): array
    {
        /* Criar a macro de ->toOptions('label', 'value', 'texto do primeiro item vazio do select. Esse usado no preprend')*/
        return Role::query()
            ->select(['name', 'id'])
            ->sort()
            ->get()
            ->map(fn($role) => [
                'label' => $role->name,
                'value' => $role->id,
            ])
            ->prepend([
                'label' => __('Administrator'),
                'value' => '',
            ])
            ->toArray();
    }
}
