@extends('agenciafmd/admix::partials.crud.form')

@section('title')

@endsection

@section('form')
    <x-admix::forms.form
            :action="route('admix.profile.update')"
            method="PUT">
        <div class="card-header bg-gray-lightest">
            <h3 class="card-title">
                Meu Perfil
            </h3>
            <div class="card-options">
                @include('agenciafmd/admix::partials.btn.save')
            </div>
        </div>

        <x-admix::forms.list-group>
            <x-admix::forms.group label="nome" for="name">
                <x-admix::forms.input name="name" required="required" :value="$model->name ?? ''"/>
            </x-admix::forms.group>

            <x-admix::forms.group label="email" for="email">
                <x-admix::forms.email name="email" required="required" :value="$model->email ?? ''"/>
            </x-admix::forms.group>

            @foreach(config('upload-configs.user') as $field => $upload)
                <x-admix::forms.group :multiple="$upload['multiple']"
                                      label="{{ $upload['label'] }} ({{ $upload['sources'][0]['width'] }}x{{ $upload['sources'][0]['height'] }})"
                                      for="{{ $field }}">
                    @if($upload['multiple'])
                        <x-ui.images name="{{ $field }}" :model="$model"/>
                    @else
                        <x-ui.image name="{{ $field }}" :model="$model"/>
                    @endif
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
        </x-admix::forms.list-group>

        <div class="card-footer bg-gray-lightest text-right">
            <div class="d-flex">
                <a href="{{ route('admix.dashboard') }}" class="js-loading btn btn-secondary">
                    Voltar
                </a>
                @include('agenciafmd/admix::partials.btn.save')
            </div>
        </div>
    </x-admix::forms.form>
@endsection