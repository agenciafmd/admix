@extends('agenciafmd/admix::partials.crud.index', [
    'route' => (request()->is('*/trash') ? route('admix.users.trash') : route('admix.users.index'))
])

@inject('roles', '\Agenciafmd\Admix\Services\RoleService')

@section('title')
    @if(request()->is('*/trash'))
        Lixeira de
    @endif
    Usuários
@endsection

@section('actions')
    @if(request()->is('*/trash'))
        @include('agenciafmd/admix::partials.btn.back', ['url' => route('admix.users.index')])
    @else
        @can('create', \Agenciafmd\Admix\Models\User::class)
            @include('agenciafmd/admix::partials.btn.create', ['url' => route('admix.users.create'), 'label' => 'Usuário'])
        @endcan
        @can('restore', \Agenciafmd\Admix\Models\User::class)
            @include('agenciafmd/admix::partials.btn.trash', ['url' => route('admix.users.trash')])
        @endcan
    @endif
@endsection

@section('batch')
    @if(request()->is('*/trash'))
        <x-admix::batchs.select name="batch" selected=""
                                :options="['' => 'com os selecionados', route('admix.users.batchRestore') => '- restaurar']"/>
    @else
        <x-admix::batchs.select name="batch" selected=""
                                :options="['' => 'com os selecionados', route('admix.users.batchDestroy') => '- remover']"/>
    @endif
@endsection

@section('filters')
    <x-admix::filters.input label="email" name="email"/>
    <x-admix::filters.select label="grupo" name="role_id"
                             :options="['' => '-', '0' => 'Administrador'] + $roles->toSelect()"/>
@endsection

@section('table')
    @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-vcenter card-table text-nowrap">
                <thead>
                <tr>
                    <th class="w-1 d-none d-md-table-cell">&nbsp;</th>
                    <th class="w-1">{!! column_sort('#', 'id') !!}</th>
                    <th class="w-1"></th>
                    <th>{!! column_sort('Nome', 'name') !!}</th>
                    <th>{!! column_sort('E-mail', 'email') !!}</th>
                    <th>{!! column_sort('Grupo', 'role_id', false) !!}</th>
                    <th class="px-0">{!! column_sort('Ativo', 'is_active') !!}</th>
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
                        <td>
                            <span class="avatar w-5 h-5" style="background-image: url({{ $item->avatar }})"></span>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ ($item->role == null) ? 'Administrador' : $item->role->name }}</td>
                        <td class="px-0">
                            @livewire('admix::is-active', ['myModel' => get_class($item), 'myId' => $item->id])
                        </td>
                        @if(request()->is('*/trash'))
                            <td class="w-1 text-right">
                                @include('agenciafmd/admix::partials.btn.restore', ['url' => route('admix.users.restore', $item->id)])
                            </td>
                        @else
                            <td class="w-1 text-center">
                                <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="icon">
                                        <i class="icon fe-more-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @can('update', \Agenciafmd\Admix\Models\User::class)
                                            @include('agenciafmd/admix::partials.btn.edit', ['url' => route('admix.users.edit', $item->id)])
                                        @endcan
                                        @can('delete', \Agenciafmd\Admix\Models\User::class)
                                            @include('agenciafmd/admix::partials.btn.remove', ['url' => route('admix.users.destroy', $item->id)])
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
