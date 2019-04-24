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
    <ul class="list-group list-group-flush">
        {!! Form::bsIsActive('Ativo', 'is_active', null, ['required']) !!}

        {!! Form::bsText('Nome', 'name', null, ['required']) !!}

        {!! Form::bsEmail('E-mail', 'email', null, ['required']) !!}

        {!! Form::bsPassword('Senha', 'password') !!}

        {!! Form::bsPassword('Confirmação de Senha', 'password_confirmation') !!}

        {!! Form::bsSelect('Grupo', 'role_id', ['0' => 'Administrador'] + $roles->toSelect()) !!}
    </ul>
    <div class="card-footer text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    {!! Form::close() !!}
@endsection