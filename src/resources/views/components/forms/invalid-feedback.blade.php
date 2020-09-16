<div class="invalid-feedback">
    @if($errors->admix->has($name))
        {{ Str::ucfirst($errors->admix->first($name)) }}
    @else
        o campo {{ Str::lower($label) }} é obrigatório
    @endif
</div>
