<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ config('admix.logo.default') }}" height="48" alt="logo" title="logo">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ __('Forgot password') }}</h2>
            <x-form wire:submit.prevent='submit'>
                <p class="text-muted mb-3">{{ __('Enter your email address and we will send a link to reset your password.') }}</p>
                <div class="mb-3">
                    <x-form.input name="email"
                                  label="{{ __('admix::fields.email') }}"/>
                </div>
                <div class="form-footer">
                    <x-btn.primary class="w-100">{{ __('Send') }}</x-btn.primary>
                </div>
            </x-form>
        </div>
    </div>
    <div class="text-center text-muted mt-3">
        {!!  __('Forget it, <a href=":url">send me back</a> to the sign in screen.', [
            'url' => route('admix.auth.login')
        ]) !!}
    </div>
</div>