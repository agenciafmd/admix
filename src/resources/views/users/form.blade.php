@extends('agenciafmd/admix::partials.crud.form')

@inject('roles', '\Agenciafmd\Admix\Services\RoleService')

@section('form')
    {{ Form::bsOpen(['model' => optional($model), 'create' => route('admix.users.store'), 'update' => route('admix.users.update', ['user' => ($model->id) ?? 0])]) }}
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">
            @if(request()->is('*/create'))
                Criar
            @elseif(request()->is('*/edit'))
                Editar
            @else
                Visualizar
            @endif
            Usuário
        </h3>
        <div class="card-options">
            @include('agenciafmd/admix::partials.btn.save')
        </div>
    </div>
    <ul class="list-group list-group-flush">
        {{ Form::bsIsActive('Ativo', 'is_active', null, ['required']) }}

        {{ Form::bsText('Nome', 'name', null, ['required']) }}

        {{ Form::bsEmail('E-mail', 'email', null, ['required']) }}

        {{ Form::bsImage('Avatar', 'image', $model) }}
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Alterar senha</h3>
    </div>
    <ul class="list-group list-group-flush">
        {{ Form::bsPassword('Senha', 'password') }}

        {{ Form::bsPassword('Confirmação de Senha', 'password_confirmation') }}
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Permissões</h3>
    </div>
    <ul class="list-group list-group-flush">
        {{ Form::bsSelect('Grupo', 'role_id', ['0' => 'Administrador'] + $roles->toSelect()) }}
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')
            @include('agenciafmd/admix::partials.btn.save')
        </div>
    </div>
    {{ Form::close() }}
@endsection