<x-form>
    <div class="card-body">
        <h2 class="mb-3">{{ __('My Account') }}</h2>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('Profile Details')"/>
                {{-- TODO: refatorar --}}
                {{--                                <div class="row align-items-center mb-3">--}}
                {{--                                    <x-form-avatar--}}
                {{--                                            name="avatar"--}}
                {{--                                            resize="400x400"--}}
                {{--                                            quality="80"--}}
                {{--                                            :media="$media"--}}
                {{--                                            placeholder="{{ Str::of(Auth::guard('admix-web')->user()->name)->acronym() }}"--}}
                {{--                                    />--}}
                {{--                                </div>--}}
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('admix::fields.name')"/>
                <x-card.subtitle :subtitle="__('Use your first and last name.')"/>
                <x-form.input name="name"/>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-xl-6">
                <x-card.title :title="__('admix::fields.email')"/>
                <x-card.subtitle :subtitle="__('Give preference to your corporate email.')"/>
                <x-form.input name="email"/>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 -col-xl-6">
                <x-card.title :title="__('admix::fields.can_notify')"/>
                <x-card.subtitle :subtitle="__('We will send weekly reports on information and improvements.')"/>
                <x-form.checkbox name="can_notify"
                                 class="form-switch form-switch-lg"
                                 :label-on="__('Yes')"
                                 :label-off="__('No')"
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
