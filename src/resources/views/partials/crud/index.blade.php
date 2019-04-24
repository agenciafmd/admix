@extends('agenciafmd/admix::master')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row page-subheader">
        <div class="col-md-3">
            {{ Form::open(['url' => $route, 'method' => 'get']) }}
            @foreach(request()->get('filter', []) as $name => $value)
                {{ Form::hidden('filter[' . $name . ']', $value) }}
            @endforeach
            <div class="form-group">
                <label class="form-label sr-only">Procurar</label>
                <div class="input-icon">
                    <input type="text" name="query" class="form-control" placeholder="Procurar..."
                           value="{{ request()->get('query', '') }}">
                    <span class="input-icon-addon">
                            <i class="fe fe-search"></i>
                        </span>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-9 text-right">
            <div class="form-group">
                <div class="btn-list">
                    @yield('actions')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="dimmer">
                    <div class="loader"></div>
                    <div class="dimmer-content">
                        <div class="card-header">
                            <div class="col-md-6 p-0">
                                <label class="d-none d-md-inline-flex mb-0 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="js-check-all custom-control-input">
                                    <span class="custom-control-label">
                                        <i class="fe fe-chevron-down"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-6 p-0 text-right">
                                <div class="form-row float-right">
                                    <div class="js-batch col-auto d-none">
                                        {{ Form::open(['url' => '', 'method' => 'post', 'class' => 'js-batch-form']) }}

                                        @yield('batch')

                                        {{ Form::close() }}
                                    </div>

                                    @yield('bar')

                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fe fe-filter"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right p-0">
                                                {{ Form::open(['url' => $route, 'method' => 'get']) }}
                                                {{ Form::hidden('query', request()->get('query')) }}
                                                <h6 class="dropdown-header bg-gray-lightest p-2">#</h6>
                                                <div class="p-2">
                                                    {{ Form::text('filter[id]', filter('id'), [
                                                            'class' => 'form-control form-control-sm'
                                                        ]) }}
                                                </div>
                                                <h6 class="dropdown-header bg-gray-lightest p-2">Ativo</h6>
                                                <div class="p-2">
                                                    {{ Form::select('filter[is_active]', [
                                                            '' => '-',
                                                            '1' => 'Sim',
                                                            '0' => 'Não'
                                                        ], filter('is_active'), [
                                                            'class' => 'form-control form-control-sm'
                                                        ]) }}
                                                </div>
                                                <h6 class="dropdown-header bg-gray-lightest p-2">Nome</h6>
                                                <div class="p-2">
                                                    {{ Form::text('filter[name]', filter('name'), [
                                                            'class' => 'form-control form-control-sm'
                                                        ]) }}
                                                </div>

                                                @yield('filters')

                                                <div class="bg-gray-lightest p-2">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="{{ $route }}"
                                                               class="btn btn-secondary btn-sm">limpar</a>
                                                        </div>
                                                        <div class="text-right col-6">
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                filtrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('bottom')
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atenção</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja remover este item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-primary">Sim</button>
                </div>
            </div>
        </div>
    </div>
@endpush
