@extends('agenciafmd/admix::partials.crud.form')

@inject('roles', '\Agenciafmd\Admix\Services\RoleService')

@section('form')
    <x-admix::cards.form title="Usuário"
                         :create="route('admix.users.store')"
                         :update="route('admix.users.update', ['user' => ($model->id) ?? 0])">
        <x-admix::forms.list-group>
            <x-admix::forms.group label="ativo" for="is_active">
                <x-admix::forms.boolean name="is_active" required="required" :selected="$model->is_active ?? ''"/>
            </x-admix::forms.group>

            <x-admix::forms.group label="nome" for="name">
                <x-admix::forms.input name="name" required="required" :value="$model->name ?? ''"/>
            </x-admix::forms.group>

            <x-admix::forms.group label="email" for="email">
                <x-admix::forms.email name="email" required="required" :value="$model->email ?? ''"/>
            </x-admix::forms.group>

            @foreach(config('upload-configs.user') as $field => $upload)
                <x-admix::forms.group :multiple="$upload['multiple']" label="{{ $upload['label'] }} ({{ $upload['sources'][0]['width'] }}x{{ $upload['sources'][0]['height'] }})" for="{{ $field }}">
                    <x-ui.image name="{{ $field }}" :model="$model"/>
{{--                    <x-dynamic-component :component="$componentName" class="mt-4" />--}}
                </x-admix::forms.group>
            @endforeach

            <x-admix::forms.group label="senha" for="password">
                <x-admix::forms.password name="password"/>
            </x-admix::forms.group>

            <x-admix::forms.group label="confirmação de senha" for="password_confirmation">
                <x-admix::forms.password name="password_confirmation"/>

                <x-slot name="help">
                    esta senha deve ser a mesma digitada acima
                </x-slot>
            </x-admix::forms.group>
            <x-admix::forms.group label="permissões" for="role_id">
                <x-admix::forms.select name="role_id" :options="['0' => 'Administrador'] + $roles->toSelect()"
                                       :selected="$model->role_id ?? 0"/>
            </x-admix::forms.group>
        </x-admix::forms.list-group>
    </x-admix::cards.form>
@endsection