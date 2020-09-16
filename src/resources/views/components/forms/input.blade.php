<x-input
        :name="$name"
        :value="$value ?? null"
        :type="$type ?? 'text'"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }}
/>