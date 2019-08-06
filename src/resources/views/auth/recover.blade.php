@extends('agenciafmd/admix::auth.master')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <img src="/images/fmd.svg" class="h-6" alt="">
                    </div>

                    @if (session()->has('status'))
                        <p class="alert alert-success text-center">
                            {{ session('status') }}
                        </p>
                    @endif

                    <form class="card" action="{{ route('admix.recover') }}" method="post">
                        {{csrf_field()}}
                        <div class="card-body p-6">
                            <div class="card-title">Esqueci minha senha</div>
                            <p class="text-muted">
                                Digite seu e-mail que enviaremos um link para você alterar sua senha
                            </p>
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail</label>
                                <input type="email" name="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                                       required autofocus/>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-muted">
                        Deixa pra lá, <a href="{{ route('admix.login') }}">quero voltar</a> para a tela de login.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection