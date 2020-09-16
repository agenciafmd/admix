<x-email
        :name="$name"
        :value="$value ?? null"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }}
/>