@extends('agenciafmd/admix::auth.master')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <img src="/images/admix-logo.svg" class="h-6" alt="">
                    </div>
                    <form class="card" action="{{ route('admix.recover.reset') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="card-body p-6">
                            <div class="card-title">Alteração de senha</div>
                            <p class="text-muted">Preencha corretamente os dados abaixo para alterar sua senha</p>
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Senha</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirmar senha</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                       placeholder="">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Alterar senha</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection