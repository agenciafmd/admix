<?php

namespace Agenciafmd\Admix\Livewire\Pages\Profile;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class ChangePassword extends Component
{
    public ChangePasswordForm $form;

    public function mount(): void
    {
        $this->form->setModel(auth('admix-web')
            ->user());
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                auth('admix-web')
                    ->logout();

                flash(__('Password changed successfully!'), 'success');

                return redirect()->to(route('admix.auth.login'));
            }

            $this->dispatch(event: 'toast', level: 'error', message: __('crud.error.save'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix::pages.profile.change-password')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }
}
