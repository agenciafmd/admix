<a class="ml-2 icon" data-toggle="modal" data-target="#auditModal{{ md5($content) }}">
    <i class="icon fe-eye text-muted"></i>
</a>

@push('bottom')
    <div class="modal fade" tabindex="-1" role="dialog" id="auditModal{{ md5($content) }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" style="word-break: break-all;">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </div>
@endpush
