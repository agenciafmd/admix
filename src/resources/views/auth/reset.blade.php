@extends('agenciafmd/admix::auth.master')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <img src="/images/fmd.svg" class="h-6" alt="">
                    </div>
                    @formOpen([route('admix.recover.reset'), 'post', ['id' => 'form-login', 'class' => 'card']])
                    @inputHidden(['token', $token])

                        <div class="card-body p-6">
                            <div class="card-title">Alteração de senha</div>
                            <p class="text-muted">Preencha corretamente os dados abaixo para alterar sua senha</p>

                            @formGroupText(['E-mail', 'email', null, ['required']])

                            @formGroupPassword(['Senha', 'password', ['required']])

                            @formGroupPassword(['Confirmar Senha', 'password_confirmation', ['required']])

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Alterar senha</button>
                            </div>
                        </div>
                    @formClose()
                </div>
            </div>
        </div>
    </div>
@endsection