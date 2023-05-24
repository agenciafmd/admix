<x-form>
    <div class="card-body">
        <h2 class="mb-3">{{ __('Change Password') }}</h2>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('admix::fields.new_password')"/>
                <x-card.subtitle :subtitle="__('Use special characters like @, #, & or !.')"/>
                <x-form.input type="password"
                              name="password"
                              wire:model.defer="password"
                />
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('admix::fields.password_confirmation')"/>
                <x-card.subtitle :subtitle="__('Repeat the password used above.')"/>
                <x-form.input type="password"
                              name="password_confirmation"
                              wire:model.defer="password_confirmation"
                />
            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent mt-auto">
        <div class="btn-list justify-content-end">
            <x-btn/>
            <x-btn.primary/>
        </div>
    </div>
</x-form>
