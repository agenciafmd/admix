@if (!((admix_cannot('view', '\Agenciafmd\Admix\User')) && (admix_cannot('view', '\Agenciafmd\Admix\Role'))))
    <li class="nav-item nav-dropdown {{ (admix_is_active(route('admix.users.index')) || admix_is_active(route('admix.roles.index'))) ? 'active' : '' }}">
        <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false">
            <i class="fe fe-users"></i> Usuários
        </a>
        <ul class="collapse list-unstyled" id="usersSubmenu">
            @can('view', '\Agenciafmd\Admix\User')
                <li class="{{ admix_is_active(route('admix.users.index')) ? 'active' : '' }}">
                    <a href="{{ route('admix.users.index') }}" class="{{ admix_is_active(route('admix.users.index')) ? 'active' : '' }}">
                        <i class="fe fe-minus"></i> Usuários
                    </a>
                </li>
            @endif
            @can('view', '\Agenciafmd\Admix\Role')
                <li class="{{ admix_is_active(route('admix.roles.index')) ? 'active' : '' }}">
                    <a href="{{ route('admix.roles.index') }}" class="{{ admix_is_active(route('admix.roles.index')) ? 'active' : '' }}">
                        <i class="fe fe-minus"></i>
                        Grupos
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif