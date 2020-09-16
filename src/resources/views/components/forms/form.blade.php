<x-form
        :action="$action"
        :method="$method"
        has-files
        {{ $attributes->merge([
            'class' => ((count($errors) > 0) ? ' was-validated' : '') . ' mb-0 card-list-group card needs-validation ',
            'novalidate' => true,
            'id' => 'formCrud',
            ]) }}>
    {{ $slot }}
</x-form>