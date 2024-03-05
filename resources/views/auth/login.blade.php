<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ config('admix.logo.default') }}" height="48" alt="logo" title="logo">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ __('Login to your account') }}</h2>
            <x-form wire:submit.prevent='submit'>
                <div class="mb-3">
                    <x-form.input type="email"
                                  name="email"
                                  label="{{ __('admix::fields.email') }}"
                    />
                </div>
                <div class="mb-3">
                    <x-form.password name="password"
                                     label="{{ __('admix::fields.password') }}"
                    />
                </div>
                <div class="mb-3">
                    <x-form.checkbox name="remember"
                                     label="{{ __('admix::fields.remember') }}"
                    />
                </div>
                <div class="form-footer">
                    <x-btn.primary class="w-100">{{ __('Sign in') }}</x-btn.primary>
                </div>
            </x-form>
        </div>
    </div>
    <div class="text-center text-muted mt-3">
        {!! __('Forgot password. <a href=":url">Click here</a>.', ['url' => route('admix.auth.forgotPassword')]) !!}
    </div>
</div>