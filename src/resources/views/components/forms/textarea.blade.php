<x-textarea
        :name="$name"
        rows="9"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }}
>{{ $slot ?? null }}</x-textarea>