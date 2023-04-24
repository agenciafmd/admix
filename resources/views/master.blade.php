<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Painel Administrativo') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Painel Administrativo Agência F&MD">
    <meta name="author" content="Agência F&MD">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS files -->
    <link href="{{ asset('/vendor/admix/vendor/tabler/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/vendor/admix/vendor/tabler/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/vendor/admix/vendor/bootstrap-toaster/css/bootstrap-toaster.min.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
          rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    {{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ config('app.version') }}">--}}
    {{--    <link rel="apple-touch-icon" href="{{ asset('images/icon-touch.png') }}?v={{ config('app.version') }}">--}}
    {{--    <link rel="icon" href="{{ asset('images/icon-fav.png') }}?v={{ config('app.version') }}">--}}
    {{--    <link rel="manifest" href="{{ asset('json/manifest.json') }}?v={{ config('app.version') }}">--}}

    <livewire:styles/>
    @stack('styles')
</head>
<body class="{{ $bodyClass ?? '' }} -d-flex -flex-column">
<div class="{{ $pageClass ?? '' }} -page -page-center">
    {{ $slot }}
</div>

{{--<div class="d-flex flex-row h-100p">--}}

{{--    @include('agenciafmd/admix::partials.menus.aside')--}}

{{--    <div class="navbar-bg"></div>--}}
{{--    <div class="layout-main d-flex flex-column flex-fill max-w-full">--}}

{{--        @include('agenciafmd/admix::partials.header')--}}

{{--        <main class="container-fluid mt-4">--}}
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</div>--}}

@stack('bottom')

<script src="{{ asset('/vendor/admix/vendor/tabler/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('/vendor/admix/vendor/bootstrap-toaster/js/bootstrap-toaster.min.js') }}" defer></script>
<script src="{{ asset('/vendor/admix/vendor/alpinejs/js/alpinejs-3.12.0.min.js') }}" defer></script>
<livewire:scripts/>

@include('admix::partials.message')

@stack('scripts')
</body>
</html>
