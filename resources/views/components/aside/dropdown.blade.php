@props([
    'icon' => '',
    'active' => false,
    'label' => '',
    'visible' => true,
    'children' => [],
])

@if($visible)
    <li @class([
        'nav-item',
        'dropdown',
        'active' => $active,
    ])>
        <a class="nav-link dropdown-toggle"
           href="#navbar-{{ Str::of($label)->slug() }}"
           data-bs-toggle="dropdown"
           data-bs-auto-close="false"
           role="button"
           aria-expanded="{{ $active }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg width="24" height="24">
                    <use xlink:href="{{ asset('vendor/admix/images/tabler-sprite.svg') }}#tabler-{{ $icon }}"/>
                </svg>
            </span>
            <span class="nav-link-title">
                {{ $label }}
            </span>
        </a>
        <div @class([
            'dropdown-menu',
            'show' => $active
        ])>
            @foreach($children as $child)
                @if($child['visible'])
                    <a @class([
                        'dropdown-item',
                        'active' => $child['active']
                    ]) href="{{ $child['url'] }}">
                        {{ $child['label'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </li>
@endif
