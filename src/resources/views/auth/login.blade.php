@extends('agenciafmd/admix::auth.master')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <img src="/images/admix-logo.svg" class="h-6" alt="">
                    </div>
                    <form class="card" action="{{ route('admix.login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="card-body p-6">
                            <div class="card-title">Painel Administrativo</div>
                            <div class="form-group">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                                       value="{{ old('email') }}" required autofocus />
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="form-label">
                                    Senha
                                    <a href="{{ route('admix.recover.form') }}" class="float-right small" tabindex="1">
                                        Esqueci minha senha
                                    </a>
                                </label>
                                <input type="password" name="password" class="form-control" id="password" required />
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember"
                                           class="custom-control-input" {{ old('remember') ? 'checked' : '' }}/>
                                    <span class="custom-control-label">Permanecer logado</span>
                                </label>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- TODO: no blur, remover o is-invalid --}}
@endsection
