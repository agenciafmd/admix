<li class="nav-item">
    <a href="{{ route('admix.dashboard') }}"
       class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.dashboard')) ? 'active' : '' }}"
       aria-expanded="{{ (Str::startsWith(request()->route()->getName(), 'admix.dashboard')) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon fe-activity"></i>
        </span>
        <span class="nav-text">
            Dashboard
        </span>
    </a>
</li>