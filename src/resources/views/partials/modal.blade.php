<div class="modal fade bd-flash-modal-sm" tabindex="-1" role="dialog" aria-labelledby="flashModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="flashModal">{{ ($title !== 'Notice') ? $title : 'Atenção' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                {!! $body !!}
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.bd-flash-modal-sm').modal()
    });
</script>