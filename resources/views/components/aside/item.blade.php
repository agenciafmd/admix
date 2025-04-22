@props([
    'icon' => '',
    'active' => false,
    'label' => '',
    'url' => '',
    'visible' => true,
])
@if($visible)
    <li @class([
            'nav-item',
            'active' => $active,
        ])>
        <a href="{{ $url }}" class="nav-link">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <x-tblr-icon name="{{ $icon }}"/>
            </span>
            <span class="nav-link-title">
                {{ $label }}
            </span>
        </a>
    </li>
@endif
