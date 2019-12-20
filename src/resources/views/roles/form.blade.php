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
    Grupos
@endsection

@section('form')
    @formModel(['model' => optional($role), 'create' => route('admix.roles.store'), 'update' => route('admix.roles.update', ['role' => ($role->id) ?? 0]), 'id' => 'formCrud', 'class' => 'mb-0 card-list-group card' . ((count($errors) > 0) ? ' was-validated' : '')])
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Geral</h3>
    </div>
    <ul class="list-group list-group-flush">
        @if (optional($role)->id)
            @formText(['Código', 'id', null, ['disabled' => true]])
        @endif

        @formIsActive(['Ativo', 'is_active', null, ['required']])

        @formText(['Nome', 'name', null, ['required']])
    </ul>
    <div class="card-body">
        <label for="permissions" class="mb-lg-4">
            Permissões

            @if($errors->admix->has('rules'))
                <small id="passwordHelpBlock" class="form-text text-red">
                    {{ ucfirst($errors->admix->first('rules')) }}
                </small>
            @endif

        </label>
        @foreach ($roles->rules()->chunk(3) as $chunk)
            <div class="row">
                @foreach ($chunk as $rule)
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-label -font-weight-normal">{{ $rule->name }}</div>
                            <div class="custom-controls-stacked">
                                @foreach($rule->policies as $policy)
                                    <label class="custom-control custom-checkbox">
                                        @inputCheckbox(['rules[]', $policy->policy])
                                        <span class="custom-control-label">pode {{ $policy->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
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