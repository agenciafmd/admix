<x-page.form
        title="{{ $role->exists ? __('Update :name', ['name' => __(config('admix.role.name'))]) : __('Create :name', ['name' => __(config('admix.role.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label for="form.is_active">
                {{ str(__('admix::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle name="form.is_active"
                           :large="true"
                           :label-on="__('Yes')"
                           :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input name="form.name" :label="__('admix::fields.name')"/>
        </div>
        <div class="col-md-6 mb-3">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <x-form.label for="role.rules">
                {{ str(__('admix::fields.rules'))->ucfirst() }}
            </x-form.label>
            <div class="row">
                @foreach ($gateRules as $rule)
                    <div class="col-md-3">
                        <label class="form-label">{{ $rule['name'] }}</label>
                        @foreach($rule['policies'] as $policy)
                            <x-form.toggle name="form.rules"
                                           :label="$policy['name']"
                                           :value="$policy['policy']"
                            />
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-slot:complement>
        @if($role->exists)
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.id')"
                                  :value="$role->id"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.created_at')"
                                  :value="$role->created_at->format(config('admix.timestamp.format'))"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.updated_at')"
                                  :value="$role->updated_at->format(config('admix.timestamp.format'))"/>
            </div>
        @endif
    </x-slot:complement>
</x-page.form>
