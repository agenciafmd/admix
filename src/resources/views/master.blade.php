<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! config('app.name') !!} | Administrativo</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Painel Administrativo Agência F&MD">
    <meta name="author" content="Agência F&MD">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

    <!--cdn-->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.1.0/font-awesome-animation.min.css"/>--}}
    {{--<link rel="stylesheet"--}}
    {{--href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"/>--}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&subset=latin-ext">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">--}}
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/admix.css') }}"/>

    @stack('styles')
</head>
<body class="">
<div class="page">
    <div class="flex-fill">
        <nav id="sidebar">
            <div class="sidebar-header py-4">
                <div class="text-center">
                    <a class="header-brand" href="/">
                        <img src="/images/admix-logo.svg" class="header-brand-img" alt="tabler logo">
                    </a>
                </div>
            </div>

            @include('agenciafmd/admix::partials.menus.menu')

        </nav>
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    {{--<a class="header-brand" href="./index.html">--}}
                        {{--<img src="/images/admix-logo.svg" class="header-brand-img" alt="tabler logo">--}}
                    {{--</a>--}}

                    <nav>
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fe fe-menu"></i>
                            <span>Menu</span>
                        </button>
                    </nav>
                    <div class="d-flex order-lg-2 ml-auto">
                        {{-- TODO: Notifications --}}
                        {{--<div class="dropdown d-none d-md-flex">
                            <a class="nav-link icon" data-toggle="dropdown">
                                <i class="fe fe-bell"></i>
                                <span class="nav-unread"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a href="#" class="dropdown-item d-flex">
                                    <span class="avatar mr-3 align-self-center"
                                          style="background-image: url(demo/faces/male/41.jpg)"></span>
                                    <div>
                                        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                                        <div class="small text-muted">10 minutes ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item d-flex">
                                    <span class="avatar mr-3 align-self-center"
                                          style="background-image: url(demo/faces/female/1.jpg)"></span>
                                    <div>
                                        <strong>Alice</strong> started new task: Tabler UI design.
                                        <div class="small text-muted">1 hour ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item d-flex">
                                    <span class="avatar mr-3 align-self-center"
                                          style="background-image: url(demo/faces/female/18.jpg)"></span>
                                    <div>
                                        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                                        <div class="small text-muted">2 hours ago</div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
                            </div>
                        </div>--}}
                        <div class="dropdown d-none d-md-flex">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url({{ image(auth('admix-web')->user(), 'image') }})"></span>
                                <span class="ml-2 d-none d-lg-block">
                                    <span class="text-default">{{ auth('admix-web')->user()->name }}</span>
                                    <small class="text-muted d-block mt-1">
                                        {{ (auth('admix-web')->user()->role == null) ? 'Administrador' : auth('admix-web')->user()->role->name }}
                                    </small>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{ route('admix.profile') }}">
                                    <i class="dropdown-icon fe fe-user"></i> Meus dados
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-settings"></i> Configurações
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admix.logout') }}">
                                    <i class="dropdown-icon fe fe-log-out"></i> Sair
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                       data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        {{--<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">--}}
        {{--<div class="container">--}}
        {{--<div class="row align-items-center">--}}
        {{--<div class="col-lg-3 ml-auto">--}}
        {{--<form class="input-icon my-3 my-lg-0">--}}
        {{--<input type="search" class="form-control header-search" placeholder="Search…" tabindex="1">--}}
        {{--<div class="input-icon-addon">--}}
        {{--<i class="fe fe-search"></i>--}}
        {{--</div>--}}
        {{--</form>--}}
        {{--</div>--}}
        {{--<div class="col-lg order-lg-first">--}}
        {{--<ul class="nav nav-tabs border-0 flex-column flex-lg-row">--}}
        {{--<li class="nav-item">--}}
        {{--<a href="./index.html" class="nav-link"><i class="fe fe-home"></i> Home</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item">--}}
        {{--<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i--}}
        {{--class="fe fe-box"></i> Interface</a>--}}
        {{--<div class="dropdown-menu dropdown-menu-arrow">--}}
        {{--<a href="./cards.html" class="dropdown-item ">Cards design</a>--}}
        {{--<a href="./charts.html" class="dropdown-item ">Charts</a>--}}
        {{--<a href="./pricing-cards.html" class="dropdown-item ">Pricing cards</a>--}}
        {{--</div>--}}
        {{--</li>--}}
        {{--<li class="nav-item dropdown">--}}
        {{--<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i--}}
        {{--class="fe fe-calendar"></i> Components</a>--}}
        {{--<div class="dropdown-menu dropdown-menu-arrow">--}}
        {{--<a href="./maps.html" class="dropdown-item ">Maps</a>--}}
        {{--<a href="./icons.html" class="dropdown-item ">Icons</a>--}}
        {{--<a href="./store.html" class="dropdown-item ">Store</a>--}}
        {{--<a href="./blog.html" class="dropdown-item ">Blog</a>--}}
        {{--<a href="./carousel.html" class="dropdown-item ">Carousel</a>--}}
        {{--</div>--}}
        {{--</li>--}}
        {{--<li class="nav-item dropdown">--}}
        {{--<a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i--}}
        {{--class="fe fe-file"></i> Pages</a>--}}
        {{--<div class="dropdown-menu dropdown-menu-arrow">--}}
        {{--<a href="./profile.html" class="dropdown-item ">Profile</a>--}}
        {{--<a href="./login.html" class="dropdown-item ">Login</a>--}}
        {{--<a href="./register.html" class="dropdown-item ">Register</a>--}}
        {{--<a href="./forgot-password.html" class="dropdown-item ">Forgot password</a>--}}
        {{--<a href="./400.html" class="dropdown-item ">400 error</a>--}}
        {{--<a href="./401.html" class="dropdown-item ">401 error</a>--}}
        {{--<a href="./403.html" class="dropdown-item ">403 error</a>--}}
        {{--<a href="./404.html" class="dropdown-item ">404 error</a>--}}
        {{--<a href="./500.html" class="dropdown-item ">500 error</a>--}}
        {{--<a href="./503.html" class="dropdown-item ">503 error</a>--}}
        {{--<a href="./email.html" class="dropdown-item ">Email</a>--}}
        {{--<a href="./empty.html" class="dropdown-item active">Empty page</a>--}}
        {{--<a href="./rtl.html" class="dropdown-item ">RTL mode</a>--}}
        {{--</div>--}}
        {{--</li>--}}
        {{--<li class="nav-item dropdown">--}}
        {{--<a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item">--}}
        {{--<a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item">--}}
        {{--<a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i>--}}
        {{--Documentation</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="my-3 my-md-4">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source
                                code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a>
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <div class="overlay"></div>
</div>


@stack('bottom')
<script src="{{ asset('js/admix.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>--}}

@include('agenciafmd/flash::partials.message')

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            // hide sidebar
            $('#sidebar').removeClass('active');
            // hide overlay
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            // open sidebar
            $('#sidebar').addClass('active');
            // fade in the overlay
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

@stack('scripts')
</body>
</html>
