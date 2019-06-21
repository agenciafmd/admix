@if (!((admix_cannot('view', '\Agenciafmd\Admix\Audit'))
    && (admix_cannot('view', '\Agenciafmd\Postal\Postal'))
    /*&& (admix_cannot('view', '\Agenciafmd\Cache\Cache'))
    && (admix_cannot('view', '\Agenciafmd\Configurations\Configurations'))*/
    ))
    <li class="nav-item nav-dropdown
        @if (
            admix_is_active(route('admix.audit.index')) ||
            admix_is_active(route('admix.postal.index')) /*||
            admix_is_active(route('admix.cache.index')) ||
            admix_is_active(route('admix.configurations.index'))*/
            ) 'active' @else '' @endif">
        <a href="#configurationsSubmenu" data-toggle="collapse" aria-expanded="false">
            <i class="fe fe-settings"></i>
            Configurações
        </a>
        <ul class="collapse list-unstyled" id="configurationsSubmenu">
            @can('view', '\Agenciafmd\Admix\Audit')
                <li class="{{ admix_is_active(route('admix.audit.index')) ? 'active' : '' }}">
                    <a href="{{ route('admix.audit.index') }}"
                       class="{{ admix_is_active(route('admix.audit.index')) ? 'active' : '' }}">
                        <i class="fe fe-minus"></i>
                        Logs
                    </a>
                </li>
            @endcan
            @if(view()->exists('agenciafmd/postal::partials.menus.item'))
                @include('agenciafmd/postal::partials.menus.item')
            @endif
            {{--@if(view()->exists('agenciafmd/cache::partials.menus.item'))--}}
                {{--@include('agenciafmd/cache::partials.menus.item')--}}
            {{--@endif--}}
            {{--@if(view()->exists('agenciafmd/configurations::partials.menus.item'))--}}
                {{--@include('agenciafmd/configurations::partials.menus.item')--}}
            {{--@endif--}}
        </ul>
    </li>
@endif