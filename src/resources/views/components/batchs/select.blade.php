<x-ui.select
        :name="$name ?? 'batch'"
        :options="$options ?? ['' => '-']"
        :selected="$selected ?? ''"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' js-batch-select form-control custom-select ']) }} />