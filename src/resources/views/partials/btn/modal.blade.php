<a role="button" data-toggle="modal" data-target="#auditModal{{ md5($content) }}">
    <i class="icon fe-eye text-muted d-md-none"></i>
    <span class="d-none d-md-inline-block">Ver</span>
</a>

@push('bottom')
    <div class="modal fade" tabindex="-1" role="dialog" id="auditModal{{ md5($content) }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="icon fe-x"></i>
                    </button>
                </div>
                <div class="modal-body" style="word-break: break-all;">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </div>
@endpush
