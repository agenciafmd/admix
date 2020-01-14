{{ Form::open(['url' => $url, 'method' => 'delete', 'class' => 'destroy', 'id' => 'formDel' . md5($url)]) }}
<a href="" class="js-delete dropdown-item">
    <i class="dropdown-icon icon fe-trash-2"></i> Remover
</a>
{{ Form::close() }}
