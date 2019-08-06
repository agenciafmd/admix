<header class="navbar navbar-expand-lg js-header">
    <div class="container-fluid p-0">
        <a class="navbar-toggler" data-toggle="collapse" data-target="#aside">
            <span class="navbar-toggler-icon"><i class="fe fe-menu"></i></span>
        </a>

        <a href="{{ config('app.url') }}" target="_blank" class="navbar-brand text-inherit mr-md-3">
            <h1 class="mb-0 mb-md-2">{{ config('app.name') }}</h1>
        </a>
{{--        TODO: filtar as models usando o spatie --}}
{{--        <div class="w-auto flex-fill max-w-md ml-0 ml-md-8 mr-auto d-none d-lg-block">--}}
{{--            <div class="input-icon">--}}
{{--                    <span class="input-icon-addon">--}}
{{--                        <i class="icon fe fe-search"></i>--}}
{{--                    </span>--}}
{{--                <input type="text" class="form-control form-control-light" placeholder="Search" tabindex="-1">--}}
{{--            </div>--}}
{{--        </div>--}}
        <ul class="nav navbar-menu align-items-center order-1 order-lg-2">
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown"
                   class="nav-link d-flex align-items-center py-0 px-lg-0 px-2 text-color ml-2">
                    <span class="avatar" style="background-image: url({{ (auth('admix-web')->user()->getFirstMediaUrl('image', 'thumb') ?: '/images/avatar-1.svg') }})"></span>
                    <span class="ml-2 d-none d-lg-block leading-none">
                        <span>{{ auth('admix-web')->user()->name }}</span>
                        <span class="text-muted d-block mt-1 text-h6">
                            {{ (auth('admix-web')->user()->role == null) ? 'Administrador' : auth('admix-web')->user()->role->name }}
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ route('admix.profile') }}">
                        <i class="dropdown-icon fe fe-user"></i> Meus dados
                    </a>
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <i class="dropdown-icon fe fe-settings"></i> Configurações--}}
{{--                    </a>--}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admix.logout') }}">
                        <i class="dropdown-icon fe fe-log-out"></i> Sair
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>