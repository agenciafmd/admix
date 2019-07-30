<li class="nav-item">
    <a class="nav-link {{ (admix_is_active(route('admix.dashboard'))) ? 'active' : '' }}" href="{{ route('admix.dashboard') }}" aria-expanded="{{ (admix_is_active(route('admix.dashboard'))) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon fe fe-activity"></i>
        </span>
        <span class="nav-text">
            Dashboard
        </span>
    </a>
</li>