<x-password
        :name="$name"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }}
/>