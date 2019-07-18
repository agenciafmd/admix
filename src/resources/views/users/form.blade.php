@extends('agenciafmd/admix::partials.crud.form')

@inject('roles', '\Agenciafmd\Admix\Services\RoleService')

@section('title')
    @if(request()->is('*/create'))
        Criar
    @elseif(request()->is('*/edit'))
        Editar
    @else
        Visualizar
    @endif
    Usuário
@endsection

@section('form')
    {!! Form::bsOpen(['model' => optional($user), 'create' => route('admix.users.store'), 'update' => route('admix.users.update', ['user' => $user->id])]) !!}
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Geral</h3>
    </div>
    <ul class="list-group list-group-flush">
        {!! Form::bsIsActive('Ativo', 'is_active', null, ['required']) !!}

        {!! Form::bsText('Nome', 'name', null, ['required']) !!}

        {!! Form::bsEmail('E-mail', 'email', null, ['required']) !!}

        {!! Form::bsImage('Avatar', 'image', $user) !!}
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Alterar senha</h3>
    </div>
    <ul class="list-group list-group-flush">
        {!! Form::bsPassword('Senha', 'password') !!}

        {!! Form::bsPassword('Confirmação de Senha', 'password_confirmation') !!}
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Permissões</h3>
    </div>
    <ul class="list-group list-group-flush">
        {!! Form::bsSelect('Grupo', 'role_id', ['0' => 'Administrador'] + $roles->toSelect()) !!}
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    {!! Form::close() !!}
@endsection