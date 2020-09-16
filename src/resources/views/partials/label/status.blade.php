@if ($status == '1')
    <label class="pl-0 custom-switch">
        <input type="radio" name="option" value="1" class="custom-switch-input" checked>
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description sr-only">Ativo</span>
    </label>
{{--    <span class="badge mr-1 bg-success"></span> Ativo--}}
@else
    <span class="badge mr-1 bg-danger"></span> Inativo
@endif