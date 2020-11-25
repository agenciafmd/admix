@extends('agenciafmd/admix::partials.crud.index', [
    'route' => (request()->is('*/trash') ? route('admix.roles.trash') : route('admix.roles.index'))
])

@section('title')
    @if(request()->is('*/trash'))
        Lixeira de
    @endif
    Grupos
@endsection

@section('actions')
    @if(request()->is('*/trash'))
        @include('agenciafmd/admix::partials.btn.back', ['url' => route('admix.roles.index')])
    @else
        @can('create', \Agenciafmd\Admix\Models\Role::class)
            @include('agenciafmd/admix::partials.btn.create', ['url' => route('admix.roles.create'), 'label' => 'Grupo'])
        @endcan
        @can('restore', \Agenciafmd\Admix\Models\Role::class)
            @include('agenciafmd/admix::partials.btn.trash', ['url' => route('admix.roles.trash')])
        @endcan
    @endif
@endsection

@section('batch')
    @if(request()->is('*/trash'))
        {{ Form::select('batch', ['' => 'com os selecionados', route('admix.roles.batchRestore') => '- restaurar'], null, ['class' => 'js-batch-select form-control custom-select']) }}
    @else
        {{ Form::select('batch', ['' => 'com os selecionados', route('admix.roles.batchDestroy') => '- remover'], null, ['class' => 'js-batch-select form-control custom-select']) }}
    @endif
@endsection

@section('filters')
@endsection

@section('table')
    @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-vcenter card-table text-nowrap">
                <thead>
                <tr>
                    <th class="w-1 d-none d-md-table-cell">&nbsp;</th>
                    <th class="w-1">{!! column_sort('#', 'id') !!}</th>
                    <th>{!! column_sort('Nome', 'name') !!}</th>
                    <th>{!! column_sort('Status', 'is_active') !!}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            <label class="mb-1 custom-control custom-checkbox">
                                <input type="checkbox" class="js-check custom-control-input"
                                       name="check[]" value="{{ $item->id }}">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                        </td>
                        <td><span class="text-muted">{{ $item->id }}</span></td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @include('agenciafmd/admix::partials.label.status', ['status' => $item->is_active])
                        </td>
                        @if(request()->is('*/trash'))
                            <td class="w-1 text-right">
                                @include('agenciafmd/admix::partials.btn.restore', ['url' => route('admix.roles.restore', $item->id)])
                            </td>
                        @else
                            <td class="w-1 text-center">
                                <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="icon">
                                        <i class="icon fe-more-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @include('agenciafmd/admix::partials.btn.show', ['url' => route('admix.roles.show', $item->id)])
                                        @can('update', \Agenciafmd\Admix\Models\Role::class)
                                            @include('agenciafmd/admix::partials.btn.edit', ['url' => route('admix.roles.edit', $item->id)])
                                        @endcan
                                        @can('delete', \Agenciafmd\Admix\Models\Role::class)
                                            @include('agenciafmd/admix::partials.btn.remove', ['url' => route('admix.roles.destroy', $item->id)])
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $items->appends(request()->except(['page']))->links() !!}
    @else
        @include('agenciafmd/admix::partials.info.not-found')
    @endif
@endsection
