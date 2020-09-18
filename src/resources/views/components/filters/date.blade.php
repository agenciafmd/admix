<h6 class="dropdown-header bg-gray-lightest p-2">{{ Str::title($label) }}</h6>
<div class="p-2">
    <x-input
            name="filter[{{ $name }}]"
            value="{{ filter($name) }}"
            type="date"
            {{ $attributes->except(['label'])->merge(['class' => ' form-control form-control-sm ']) }}
    />
</div>