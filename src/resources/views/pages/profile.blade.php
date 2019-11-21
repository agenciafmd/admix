@extends('agenciafmd/admix::partials.crud.form')

@section('title', '')

@section('form')
    @formModel(['model' => $user, 'update' => route('admix.profile.update'), 'id' => 'formCrud', 'class' => 'card-list-groud card' . ((count($errors) > 0) ? ' was-validated' : '')])

    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Meu Perfil</h3>
    </div>
    <ul class="list-group list-group-flush">
        @formText(['Nome', 'name', null, ['required']])
        @formEmail(['E-mail', 'email', null, ['required']])

        {{--        {!! Form::bsImage('Avatar', 'image', $user) !!}--}}
    </ul>
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Alterar senha</h3>
    </div>
    <ul class="list-group list-group-flush">
        @formPassword(['Senha', 'password'])
        @formPassword(['Confirmação de Senha', 'password_confirmation'])
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            <a href="{{ route('admix.dashboard') }}" class="js-loading btn btn-secondary">
                Voltar
            </a>

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    @formClose()
@endsection