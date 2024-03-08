<x-page.form
        headerTitle="{{ $user->id ? __('Update :name', ['name' => __(config('admix.user.name'))]) : __('Create :name', ['name' => __(config('admix.user.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label for="user.is_active">
                {{ str(__('admix::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.checkbox name="user.is_active"
                             class="form-switch form-switch-lg"
                             :label-on="__('Yes')"
                             :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.label for="user.can_notify">
                {{ str(__('admix::fields.can_notify'))->ucfirst() }}
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
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.select name="user.role_id"
                           :label="__('admix::fields.role_id')"
                           :options="$roles"
                           :placeholder="__('Administrator')"
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
