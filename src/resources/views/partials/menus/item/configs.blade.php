@if (!((admix_cannot('view', '\Agenciafmd\Admix\Audit'))
    && (admix_cannot('view', '\Agenciafmd\Postal\Postal'))
    /*&& (admix_cannot('view', '\Agenciafmd\Cache\Cache'))
    && (admix_cannot('view', '\Agenciafmd\Configurations\Configurations'))*/
    ))
    <li class="nav-item">
        <a class="nav-link @if (
            admix_is_active(route('admix.audit.index')) ||
            admix_is_active(route('admix.postal.index')) /*||
            admix_is_active(route('admix.cache.index')) ||
            admix_is_active(route('admix.configurations.index'))*/
            ) active @endif"
           href="#sidebar-settings" data-toggle="collapse" data-parent="#menu" role="button" aria-expanded="{{ (admix_is_active(route('admix.audit.index')) || admix_is_active(route('admix.postal.index'))) ? 'true' : 'false' }}">
            <span class="nav-icon">
                <i class="icon fe-settings"></i>
            </span>
            <span class="nav-text">
                Configurações
            </span>
        </a>
        <div class="navbar-subnav collapse @if (
            admix_is_active(route('admix.audit.index')) ||
            admix_is_active(route('admix.postal.index')) /*||
            admix_is_active(route('admix.cache.index')) ||
            admix_is_active(route('admix.configurations.index'))*/
            ) show @endif"
             id="sidebar-settings">
            <ul class="nav">
                @can('view', '\Agenciafmd\Admix\Audit')
                    <li class="nav-item">
                        <a class="nav-link {{ admix_is_active(route('admix.audit.index')) ? 'active' : '' }}"
                           href="{{ route('admix.audit.index') }}">
                            <span class="nav-icon">
                                <i class="icon fe-minus"></i>
                            </span>
                            <span class="nav-text">
                                Logs
                            </span>
                        </a>
                    </li>
                @endcan
                @if(view()->exists('agenciafmd/postal::partials.menus.item'))
                    @include('agenciafmd/postal::partials.menus.item')
                @endif
            </ul>
        </div>
    </li>
@endif