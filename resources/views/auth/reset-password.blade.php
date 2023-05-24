<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ config('admix.logo.default') }}" height="48" alt="logo" title="logo">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ __('Reset password') }}</h2>
            <x-form>
                <p class="text-muted mb-3">{{ __('Enter your email address and your new password.') }}</p>
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
                    <x-form.password name="password_confirmation"
                                     label="{{ __('admix::fields.password_confirmation') }}"
                    />
                </div>
                <div class="form-footer">
                    <x-btn.primary class="w-100">{{ __('Reset password') }}</x-btn.primary>
                </div>
            </x-form>
        </div>
    </div>
</div>