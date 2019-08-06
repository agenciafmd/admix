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

    <!-- uploads / medialibrary -->
    <meta name="upload" content="{{ route('admix.upload.index') }}">
    <meta name="upload-meta" content="{{ route('admix.upload.meta', ['key' => '']) }}">
    <meta name="upload-destroy" content="{{ route('admix.upload.destroy') }}">

    <link rel="shortcut icon" href="/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

    <!--cdn-->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&subset=latin-ext">
    <link rel="stylesheet" href="{{ asset('css/admix.css') }}"/>

    @stack('styles')
</head>
<body class="antialiased ">

<div class="d-flex flex-row h-100p">

    @include('agenciafmd/admix::partials.menus.aside')

    <div class="navbar-bg"></div>
    <div class="layout-main d-flex flex-column flex-fill max-w-full">

        @include('agenciafmd/admix::partials.header')

        <main class="container-fluid mt-4">
            @yield('content')
        </main>
    </div>
</div>

<script>
    window.tabler = window.tabler || {};
    window.tabler.colors = {
        'blue': '#206bc4',
        'azure': '#45aaf2',
        'indigo': '#6574cd',
        'purple': '#a55eea',
        'pink': '#f66d9b',
        'red': '#fa4654',
        'orange': '#fd9644',
        'yellow': '#f1c40f',
        'lime': '#7bd235',
        'green': '#5eba00',
        'teal': '#2bcbba',
        'cyan': '#17a2b8',
        'gray': '#868e96',
        'dark': '#354051',
    };
</script>

<script>document.body.style.display = 'block';</script>

@stack('bottom')

<script src="{{ asset('js/admix.js') }}"></script>

@include('agenciafmd/flash::partials.message')

@stack('scripts')
</body>
</html>
