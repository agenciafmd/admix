@extends('agenciafmd/admix::partials.crud.form')

@inject('roles', '\Agenciafmd\Admix\Services\RoleService')

@section('form')
    @formModel(['model' => optional($user), 'create' => route('admix.users.store'), 'update' => route('admix.users.update', ['user' => ($user->id) ?? 0]), 'id' => 'formCrud', 'class' => 'mb-0 card-list-group card' . ((count($errors) > 0) ? ' was-validated' : '')])
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
            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    <ul class="list-group list-group-flush">
        @if (optional($user)->id)
            @formText(['Código', 'id', null, ['disabled' => true]])
        @endif

        @formIsActive(['Ativo', 'is_active', null, ['required']])

        @formText(['Nome', 'name', null, ['required']])

        @formEmail(['Email', 'email', null, ['required']])

        @formImage(['Avatar', 'image', $user])
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Alterar senha</h3>
    </div>
    <ul class="list-group list-group-flush">
        @formPassword(['Senha', 'password'])

        @formPassword(['Confirmação de Senha', 'password_confirmation'])
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Permissões</h3>
    </div>
    <ul class="list-group list-group-flush">
        @formSelect(['Grupo', 'role_id', ['0' => 'Administrador'] + $roles->toSelect()])
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    @formClose()
@endsection