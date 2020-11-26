@canany('view', [\Agenciafmd\Admix\Models\Audit::class, \Agenciafmd\Postal\Models\Postal::class])
    <li class="nav-item">
        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), ['admix.audit', 'admix.postal'])) ? 'active' : '' }}"
           href="#sidebar-settings" data-toggle="collapse" data-parent="#menu" role="button" aria-expanded="{{ (Str::startsWith(request()->route()->getName(), ['admix.audit', 'admix.postal'])) ? 'true' : 'false' }}">
            <span class="nav-icon">
                <i class="icon fe-settings"></i>
            </span>
            <span class="nav-text">
                Configurações
            </span>
        </a>
        <div class="navbar-subnav collapse {{ (Str::startsWith(request()->route()->getName(), ['admix.audit', 'admix.postal'])) ? 'active' : '' }}"
             id="sidebar-settings">
            <ul class="nav">
                @can('view', \Agenciafmd\Admix\Models\Audit::class)
                    <li class="nav-item">
                        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.audit')) ? 'active' : '' }}"
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
@endcanany