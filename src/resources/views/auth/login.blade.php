@extends('agenciafmd/admix::auth.master')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <img src="/images/fmd.svg" class="h-6" alt="">
                    </div>
                    @formOpen([route('admix.login'), 'post', ['id' => 'form-login', 'class' => 'card']])
                    <div class="card-body p-6">
                        <div class="card-title">Painel Administrativo</div>

                        @formGroupEmail(['E-mail', 'email', null, ['required']])

                        @formGroupPassword(['Senha', 'password', ['required']])

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            <a href="{{ route('admix.recover.form') }}" class="btn btn-link btn-block text-lowercase">
                                esqueci minha senha
                            </a>
                        </div>
                    </div>
                    @formClose()
                </div>
            </div>
        </div>
    </div>
@endsection
