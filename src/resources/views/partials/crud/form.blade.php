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

@push('styles')
    <style>
        .editor-toolbar.fullscreen {
            z-index: 1020;
        }

        .CodeMirror-fullscreen {
            z-index: 1020;
        }

        .CodeMirror-scroll, .editor-preview {
            color: #495057;
        }

        .CodeMirror {
            border: 1px solid rgba(0, 0, 0, 0.09);
            margin-top: -7px;
        }

        .editor-toolbar {
            border-top: 1px solid rgba(0, 0, 0, 0.09);
            border-left: 1px solid rgba(0, 0, 0, 0.09);
            border-right: 1px solid rgba(0, 0, 0, 0.09);
            padding: 0 5px;
        }

        .editor-toolbar button {
            color: #343a40;
        }

        .editor-toolbar:before {
            margin-bottom: 4px;
        }

        .editor-toolbar:after {
            margin-bottom: 4px;
        }
    </style>
@endpush