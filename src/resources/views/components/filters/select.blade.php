<h6 class="dropdown-header bg-gray-lightest p-2">{{ Str::title($label) }}</h6>
<div class="p-2">
    <x-ui.select
            :name="'filter[$name]'"
            :options="$options ?? ['' => '-']"
            selected="{{ filter($name) }}"
            {{ $attributes->except(['label', 'name'])->merge(['name' => 'filter[' . $name . ']', 'class' => ' form-control form-control-sm custom-select ']) }} />
</div>
