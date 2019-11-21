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

                    @formOpen([route('admix.recover'), 'post', ['id' => 'form-login', 'class' => 'card']])
                    <div class="card-body p-6">
                        <div class="card-title">Esqueci minha senha</div>
                        <p class="text-muted">
                            Digite seu e-mail que enviaremos um link para você alterar sua senha
                        </p>

                        @formGroupEmail(['E-mail', 'email', null, ['required']])

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            <a href="{{ route('admix.login') }}" class="btn btn-link btn-block text-lowercase">
                                voltar
                            </a>
                        </div>
                    </div>
                    @formClose()
                </div>
            </div>
        </div>
    </div>
@endsection
