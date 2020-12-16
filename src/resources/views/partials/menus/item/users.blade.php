@canany('view', [\Agenciafmd\Admix\Models\User::class, \Agenciafmd\Admix\Models\Role::class])
    <li class="nav-item">
        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), ['admix.users', 'admix.roles'])) ? 'active' : '' }}"
           href="#sidebar-user"
           data-toggle="collapse"
           data-parent="#menu"
           role="button"
           aria-expanded="{{ (Str::startsWith(request()->route()->getName(), ['admix.users', 'admix.roles'])) ? 'true' : 'false' }}">
            <span class="nav-icon">
                <i class="icon fe-users"></i>
            </span>
            <span class="nav-text">
                Usuários
            </span>
        </a>
        <div class="navbar-subnav collapse {{ (Str::startsWith(request()->route()->getName(), ['admix.users', 'admix.roles'])) ? 'show' : '' }}"
             id="sidebar-user">
            <ul class="nav">
                @can('view', \Agenciafmd\Admix\Models\User::class)
                    <li class="nav-item">
                        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.users')) ? 'active' : '' }}"
                           href="{{ route('admix.users.index') }}">
                            <span class="nav-icon">
                                <i class="icon fe-minus"></i>
                            </span>
                            <span class="nav-text">
                                Usuários
                            </span>
                        </a>
                    </li>
                @endcan
                @can('view', \Agenciafmd\Admix\Models\Role::class)
                    <li class="nav-item">
                        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.roles')) ? 'active' : '' }}"
                           href="{{ route('admix.roles.index') }}">
                            <span class="nav-icon">
                                <i class="icon fe-minus"></i>
                            </span>
                            <span class="nav-text">
                                Grupos
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcanany