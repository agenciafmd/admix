<x-ui.select
        :name="$name"
        :options="$options ?? ['' => '-', '1' => 'Sim', '0' => 'Não']"
        :selected="$selected ?? ''"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }} />