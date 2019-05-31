{!! Form::open(['url' => $url, 'method' => 'delete', 'class' => 'destroy', 'id' => 'formDel' . substr($url, -1)]) !!}
<a href="" class="js-delete dropdown-item">
    <i class="dropdown-icon fe fe-trash-2"></i> Remover
</a>
{!! Form::close() !!}
