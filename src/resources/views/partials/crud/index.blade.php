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
                                        <form method="post" action="" class="js-batch-form" accept-charset="UTF-8">
                                            @csrf
                                            @yield('batch')
                                        </form>
                                    </div>

                                    @yield('bar')

                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="icon fe-filter d-md-none"></i>
                                                <span class="d-none d-md-inline">Filtrar</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right p-0">
                                                <form method="get" action="{{ $route }}" accept-charset="UTF-8">
                                                    <input type="hidden" name="query"
                                                           value="{{ request()->get('query') }}">

                                                    <x-admix::filters.input label="#" name="id"/>

                                                    <x-admix::filters.select label="ativo" name="is_active"
                                                                             :options="['' => '-', '1' => 'Sim', '0' => 'Não']"/>

                                                    <x-admix::filters.input label="nome" name="name"/>

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
                                                </form>
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
