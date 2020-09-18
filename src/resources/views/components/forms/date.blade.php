<x-input
        type="date"
        :name="$name"
        :value="$value ?? null"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }}
/>