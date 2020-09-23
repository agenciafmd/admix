<form action="{{ $url }}" method="POST" class="destroy" id="formDelete{{ md5($url) }}">
    @csrf
    @method('delete')
    <a href="#" class="js-delete dropdown-item">
        <i class="dropdown-icon icon fe-trash-2"></i> Remover
    </a>
</form>