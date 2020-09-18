@extends('agenciafmd/admix::partials.crud.index', [
    'route' => route('admix.audit.index')
])

@inject('users', '\Agenciafmd\Admix\Services\UserService')

@section('title')
    Logs
@endsection

@section('actions')
@endsection

@section('batch')
@endsection

@section('filters')
    <x-admix::filters.select label="local" name="auditable_type"
                             :options="['' => '-'] + audit_alias()"/>
    <x-admix::filters.select label="usuário" name="user_id"
                             :options="['' => '-'] + $users->toSelect()"/>
    <x-admix::filters.select label="evento" name="event"
                             :options="['' => '-'] + audit_events()"/>
    <x-admix::filters.input label="registro" name="auditable_id"/>
    <x-admix::filters.date label="Data" name="created_at"/>
@endsection

@section('table')
    @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-vcenter card-table text-nowrap">
                <thead>
                <tr>
                    <th class="w-1">{!! column_sort('#', 'id') !!}</th>
                    <th>{!! column_sort('Local', 'auditable_type') !!}</th>
                    <th>{!! column_sort('Usuário', 'user.name', false) !!}</th> <!-- TODO -->
                    <th>{!! column_sort('Evento', 'event') !!}</th>
                    <th>{!! column_sort('Registro', 'auditable_id') !!}</th>
                    <th>{!! column_sort('Data', 'created_at') !!}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><span class="text-muted">{{ $item->id }}</span></td>
                        <td>{{ audit_alias($item->auditable_type) }}</td>
                        <td>{{ optional($item->user)->name }}</td>
                        <td>{{ audit_events($item->event) }}</td>
                        <td>{{ $item->auditable_id }}</td>
                        <td>{{ $item->created_at->isoFormat('DD/MM/Y HH:mm') }}</td>
                        <td class="w-1 text-right">
                            @include('agenciafmd/admix::partials.btn.modal', ['content' => $item->log])
                        </td>
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

@push('styles')
    <style>
        .dropdown-menu .p-2:nth-child(4),
        .dropdown-menu .p-2:nth-child(5),
        .dropdown-menu .p-2:nth-child(6),
        .dropdown-menu .p-2:nth-child(7),
        .page-subheader {
            display: none;
        }

        .dimmer-content > .card-header > .col-md-6:nth-child(1) {
            visibility: hidden;
        }
    </style>
@endpush