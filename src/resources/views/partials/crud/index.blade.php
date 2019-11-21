@extends('agenciafmd/admix::master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="dimmer">
                    <div class="loader text-muted"></div>
                    <div class="dimmer-content">
                        <div class="card-header bg-gray-lightest">
                            <h3 class="card-title">@yield('title')</h3>
                            <div class="card-options">
                                @yield('actions')
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="col-md-6 p-0">
                                <label class="d-none d-md-inline-flex mb-0 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="js-check-all custom-control-input">
                                    <span class="custom-control-label">
                                        <i class="icon fe-chevron-down"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-6 p-0 text-right">
                                <div class="form-row float-right">
                                    <div class="js-batch col-auto d-none">
                                        @formOpen(['', 'post', ['class' => 'js-batch-form']])

                                        @yield('batch')

                                        @formClose()
                                    </div>

                                    @yield('bar')

                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="icon fe-filter"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right p-0">
                                                @formOpen([$route, 'get'])
                                                @inputHidden(['query', request()->get('query')])
                                                <h6 class="dropdown-header bg-gray-lightest p-2">#</h6>
                                                <div class="p-2">
                                                    @inputText(['filter[id]', filter('id'), [
                                                    'class' => 'form-control form-control-sm'
                                                    ]])
                                                </div>
                                                <h6 class="dropdown-header bg-gray-lightest p-2">Ativo</h6>
                                                <div class="p-2">
                                                    @inputSelect(['filter[is_active]', [
                                                            '' => '-',
                                                            '1' => 'Sim',
                                                            '0' => 'Não'
                                                        ], filter('is_active'), [
                                                            'class' => 'form-control form-control-sm'
                                                    ]])
                                                </div>
                                                <h6 class="dropdown-header bg-gray-lightest p-2">Nome</h6>
                                                <div class="p-2">
                                                    @inputText(['filter[name]', filter('name'), [
                                                    'class' => 'form-control form-control-sm'
                                                    ]])
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
                                                @formClose()
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
