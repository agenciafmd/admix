<x-ui.select
        :name="$name"
        :options="$options ?? ['' => '-']"
        :selected="$selected ?? ''"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }} />