<?php

namespace Agenciafmd\Admix\Livewire\Pages\Profile;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class MyAccount extends Component
{
    public MyAccountForm $form;

    public function mount(): void
    {
        $this->form->setModel(auth('admix-web')
            ->user());
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                $this->dispatch(event: 'toast', level: 'success', message: __('crud.success.save'));
            } else {
                $this->dispatch(event: 'toast', level: 'error', message: __('crud.error.save'));
            }
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix::pages.profile.my-account')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }
}
