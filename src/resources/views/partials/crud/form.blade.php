@extends('agenciafmd/admix::master')

@section('content')
    <div class="row">
        <div class="col-12">
            @yield('form')
        </div>
    </div>
@endsection

@push('bottom')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalMediaMetaPost">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar descrição</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endpush
