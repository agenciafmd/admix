{!! Form::open(['url' => $url, 'method' => 'delete', 'class' => 'destroy', 'id' => 'formDel' . substr($url, -1)]) !!}
<a class="js-delete ml-2 icon">
    <i class="fe fe-trash-2"></i>
</a>
{!! Form::close() !!}
