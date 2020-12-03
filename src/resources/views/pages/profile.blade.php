@extends('agenciafmd/admix::partials.crud.form')

@section('title')

@endsection

@section('form')
    {{ Form::model($user, ['url' => route('admix.profile.update'), 'method' => 'PUT',
        'class' => 'card-list-group card needs-validation' . ((count($errors) > 0) ? ' was-validated' : ''),
        'novalidate' => true, 'id' => 'formCrud', 'files' => true]) }}
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">
            Meu Perfil
        </h3>
        <div class="card-options">
            @include('agenciafmd/admix::partials.btn.save')
        </div>
    </div>
    <ul class="list-group list-group-flush">
        {{ Form::bsText('Nome', 'name', null, ['-required']) }}

        {{ Form::bsEmail('E-mail', 'email', null, ['required']) }}

        {{ Form::bsImage('Avatar', 'image', $user) }}
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Alterar senha</h3>
    </div>
    <ul class="list-group list-group-flush">
        {{ Form::bsPassword('Senha', 'password') }}

        {{ Form::bsPassword('Confirmação de Senha', 'password_confirmation') }}
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')
            @include('agenciafmd/admix::partials.btn.save')
        </div>
    </div>
    {{ Form::close() }}
@endsection