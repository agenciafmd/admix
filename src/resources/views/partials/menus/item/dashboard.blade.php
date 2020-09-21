<li class="nav-item">
    <a href="{{ route('admix.dashboard') }}"
       class="nav-link {{ (admix_is_active(route('admix.dashboard'))) ? 'active' : '' }}"
       aria-expanded="{{ (admix_is_active(route('admix.dashboard'))) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon fe-activity"></i>
        </span>
        <span class="nav-text">
            Dashboard
        </span>
    </a>
</li>