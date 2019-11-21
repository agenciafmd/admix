@formOpen([$url, 'delete', ['id' => 'formDel' . md5($url), 'class' => 'destroy']])
<a href="" class="js-delete dropdown-item">
    <i class="dropdown-icon icon fe-trash-2"></i> Remover
</a>
@formClose()
