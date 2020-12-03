<form action="{{ $url }}" method="POST" class="restore" id="formRestore{{ md5($url) }}">
    @csrf
    <a role="button" class="js-dimmer js-submit">
        <i class="icon fe-refresh-cw text-muted d-md-none"></i>
        <span class="d-none d-md-inline-block">Restaurar</span>
    </a>
</form>