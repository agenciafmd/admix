<x-form>
    <div class="card-body">
        <h2 class="mb-3">{{ __('My Account') }}</h2>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('Profile Details')"/>
                {{--                <x-form.file name="model.avatar"/>--}}
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('admix::fields.name')"/>
                <x-card.subtitle :subtitle="__('Use your first and last name.')"/>
                <x-form.input name="form.name"/>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('admix::fields.email')"/>
                <x-card.subtitle :subtitle="__('Give preference to your corporate email.')"/>
                <x-form.input name="form.email"/>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 -col-xl-6">
                <x-card.title :title="__('admix::fields.can_notify')"/>
                <x-card.subtitle :subtitle="__('We will send weekly reports on information and improvements.')"/>
                <x-form.toggle name="form.can_notify"
                               class="form-switch-lg"
                               :label-on="__('Yes')"
                               :label-off="__('No')"
                />
                {{--                <x-form.checkbox name="form.can_notify"--}}
                {{--                                 class="form-switch form-switch-lg"--}}
                {{--                                 :label-on="__('Yes')"--}}
                {{--                                 :label-off="__('No')"--}}
                {{--                />--}}
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
