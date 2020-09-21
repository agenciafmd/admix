{{ Form::open(['url' => $url, 'method' => 'post', 'class' => 'restore', 'id' => 'formRestore' . md5($url)]) }}
<a role="button" class="js-dimmer js-submit">
    <i class="icon fe-refresh-cw text-muted d-md-none"></i>
    <span class="d-none d-md-inline-block">Restaurar</span>
</a>
{{ Form::close() }}