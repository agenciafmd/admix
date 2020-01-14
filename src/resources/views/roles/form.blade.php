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
    {!! Form::bsOpen(['model' => optional($model), 'create' => route('admix.roles.store'), 'update' => route('admix.roles.update', ['role' => ($model->id) ?? 0])]) !!}
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">Geral</h3>
    </div>
    <ul class="list-group list-group-flush">
        {!! Form::bsIsActive('Ativo', 'is_active', null, ['required']) !!}

        {!! Form::bsText('Nome', 'name', null, ['required']) !!}
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
                                        @php
                                            $attributes['disabled'] = false;
                                            if(strpos(request()->route()->getName(), 'show') !== false) {
                                                $formControl = 'form-control-plaintext';
                                                $attributes['disabled'] = true;
                                            }
                                        @endphp

                                        {{ Form::checkbox('rules[]', $policy->policy, null, ['class' => 'custom-control-input'] + $attributes) }}
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
    {!! Form::close() !!}
@endsection