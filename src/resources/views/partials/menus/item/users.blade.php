@if (!((admix_cannot('view', '\Agenciafmd\Admix\User')) && (admix_cannot('view', '\Agenciafmd\Admix\Role'))))
    <li class="nav-item">
        <a class="nav-link {{ (admix_is_active(route('admix.users.index')) || admix_is_active(route('admix.roles.index'))) ? 'active' : '' }}"
           href="#sidebar-user" data-toggle="collapse" data-parent="#menu" role="button" aria-expanded="{{ (admix_is_active(route('admix.users.index')) || admix_is_active(route('admix.roles.index'))) ? 'true' : 'false' }}">
            <span class="nav-icon">
                <i class="icon fe-users"></i>
            </span>
            <span class="nav-text">
                Usuários
            </span>
        </a>
        <div class="navbar-subnav collapse {{ (admix_is_active(route('admix.users.index')) || admix_is_active(route('admix.roles.index'))) ? 'show' : '' }}"
             id="sidebar-user">
            <ul class="nav">
                @can('view', '\Agenciafmd\Admix\User')
                    <li class="nav-item">
                        <a class="nav-link {{ admix_is_active(route('admix.users.index')) ? 'active' : '' }}"
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
                @can('view', '\Agenciafmd\Admix\Role')
                    <li class="nav-item">
                        <a class="nav-link {{ admix_is_active(route('admix.roles.index')) ? 'active' : '' }}"
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
@endif