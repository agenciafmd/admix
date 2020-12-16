<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! config('app.name') !!} | Administrativo</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Painel Administrativo Agência F&MD">
    <meta name="author" content="Agência F&MD">

    <link rel="shortcut icon" href="{{ asset('/images/admix/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('/images/admix/favicon.png') }}">

    <!--cdn-->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"/>--}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&subset=latin-ext">

    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/admix.css') }}"/>

</head>
<body class="h-100">
<div class="page">
    @yield('content')
</div>

{{--<script src="{{ asset('js/backend.js') }}"></script>--}}

{{--@include('agenciafmd/flash::partials.message')--}}
</body>
</html>