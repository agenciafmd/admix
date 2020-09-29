<h6 class="dropdown-header bg-gray-lightest p-2">{{ Str::title($label) }} a partir de</h6>
<div class="p-2">
    <x-input
            name="filter[{{ $name . '_gt' }}]"
            value="{{ filter($name . '_gt') }}"
            type="date"
            {{ $attributes->except(['label'])->merge(['class' => ' form-control form-control-sm ']) }}
    />
</div>
<h6 class="dropdown-header bg-gray-lightest p-2">{{ Str::title($label) }} até</h6>
<div class="p-2">
    <x-input
            name="filter[{{ $name . '_lt' }}]"
            value="{{ filter($name . '_lt' ) }}"
            type="date"
            {{ $attributes->except(['label'])->merge(['class' => ' form-control form-control-sm ']) }}
    />
</div>