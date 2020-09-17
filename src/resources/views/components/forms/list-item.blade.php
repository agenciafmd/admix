@props(['multiple' => false])
<li class="list-group-item">
    <div class="row gutters-sm {{ ($multiple) ? 'multiple-upload' : 'single-upload' }}">
        {{ $label }}

        <div class="col-xl-5">
            {{ $slot }}
        </div>

        @isset($help)
            <small id="help" class="mt-2 form-text col text-muted">
                {{ $help }}
            </small>
        @endisset
    </div>
</li>