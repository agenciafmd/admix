<x-page.form
        headerTitle="{{ $user->exists ? __('Update :name', ['name' => __(config('admix.user.name'))]) : __('Create :name', ['name' => __(config('admix.user.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label for="user.is_active">
                {{ str(__('admix::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle name="form.is_active"
                           :large="true"
                           :label-on="__('Yes')"
                           :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.label for="form.can_notify">
                {{ str(__('admix::fields.can_notify'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle name="form.can_notify"
                           :large="true"
                           :label-on="__('Yes')"
                           :label-off="__('No')"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input name="form.name" :label="__('admix::fields.name')"/>
        </div>
        <div class="col-md-6 mb-3">
            <x-form.input name="form.email" :label="__('admix::fields.email')"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <x-form.image-library
                    name="form.library_files"
                    :label="__('admix::fields.library_files')"
                    wire:library="library"
                    :preview="$this?->form?->library ?? collect()"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.password name="form.password"
                             :label="__('admix::fields.password')"
                             wire:model.defer="form.password"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.password name="form.password_confirmation"
                             :label="__('admix::fields.password_confirmation')"
                             wire:model.defer="form.password_confirmation"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.select name="form.role_id"
                           :label="__('admix::fields.role_id')"
                           :options="$roleOptions"
                           :placeholder="__('Administrator')"
            />
        </div>
    </div>
    <x-slot:complement>
        @if($user->exists)
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
    </x-slot:complement>
</x-page.form>
