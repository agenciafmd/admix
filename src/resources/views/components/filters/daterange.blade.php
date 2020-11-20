@php
    $labelBefore = $label;
    $labelAfter = $label;
    if(strpos($label, ',')) {
        $labelBefore = explode(',', $label)[0];
        $labelAfter = explode(',', $label)[1];
    }

    $nameBefore = $name;
    $nameAfter = $name;
    if(strpos($name, ',')) {
        $nameBefore = explode(',', $name)[0];
        $nameAfter = explode(',', $name)[1];
    }
@endphp

<h6 class="dropdown-header bg-gray-lightest p-2">{{ Str::title($labelBefore) }} a partir de</h6>
<div class="p-2">
    <x-input
            name="filter[{{ $nameBefore . '_gt' }}]"
            value="{{ filter($nameBefore . '_gt') }}"
            type="date"
            {{ $attributes->except(['label'])->merge(['class' => ' form-control form-control-sm ']) }}
    />
</div>
<h6 class="dropdown-header bg-gray-lightest p-2">{{ Str::title($labelAfter) }} até</h6>
<div class="p-2">
    <x-input
            name="filter[{{ $nameAfter . '_lt' }}]"
            value="{{ filter($nameAfter . '_lt' ) }}"
            type="date"
            {{ $attributes->except(['label'])->merge(['class' => ' form-control form-control-sm ']) }}
    />
</div>