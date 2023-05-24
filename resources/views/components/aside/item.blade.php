@props([
    'icon' => '',
    'active' => '',
    'label' => '',
    'url' => '',
])
<li @class([
        'nav-item',
        'active' => $active,
    ])>
    <a href="{{ $url }}" class="nav-link">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <svg width="24" height="24">
                <use xlink:href="{{ asset('vendor/admix/images/tabler-sprite.svg') }}#tabler-{{ $icon }}"/>
            </svg>
        </span>
        <span class="nav-link-title">
            {{ $label }}
        </span>
    </a>
</li>
