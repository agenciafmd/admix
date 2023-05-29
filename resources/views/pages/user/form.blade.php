<x-page.form
        headerTitle="{{ $user->id ? __('Update :name', ['name' => __(config('admix.user.name'))]) : __('Create :name', ['name' => __(config('admix.user.name'))]) }}">
    {{--    <x-slot:headerActions>--}}
    {{--        <div class="col-auto ms-auto d-print-none">--}}
    {{--            <div class="d-flex">--}}
    {{--                <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…">--}}
    {{--                <a href="#" class="btn btn-primary">--}}
    {{--                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->--}}
    {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>--}}
    {{--                    New user--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </x-slot:headerActions>--}}

    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label for="user.is_active">
                {{ Str::of(__('admix::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.checkbox name="user.is_active"
                             class="form-switch form-switch-lg"
                             :label-on="__('Yes')"
                             :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.label for="user.can_notify">
                {{ Str::of(__('admix::fields.can_notify'))->ucfirst() }}
            </x-form.label>
            <x-form.checkbox name="user.can_notify"
                             class="form-switch form-switch-lg"
                             :label-on="__('Yes')"
                             :label-off="__('No')"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input name="user.name" :label="__('admix::fields.name')"/>
        </div>
        <div class="col-md-6 mb-3">
            <x-form.input name="user.email" :label="__('admix::fields.email')"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.password name="password"
                             :label="__('admix::fields.password')"
                             wire:model.defer="password"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.password name="password_confirmation"
                             :label="__('admix::fields.password_confirmation')"
                             wire:model.defer="password_confirmation"
            />
        </div>
    </div>

    <x-slot:cardComplement>
        @if($user->id)
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.id')"
                                  :value="$user->id"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.created_at')"
                                  :value="$user->created_at->format(config('admix.timestamp.format'))"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.updated_at')"
                                  :value="$user->updated_at->format(config('admix.timestamp.format'))"/>
            </div>
        @endif
    </x-slot:cardComplement>
</x-page.form>
