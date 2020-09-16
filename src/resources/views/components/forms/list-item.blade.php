<li class="list-group-item">
    <div class="row gutters-sm">
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