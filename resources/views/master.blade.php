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
    <link href="{{ asset('/vendor/admix/vendor/bootstrap-toaster/css/bootstrap-toaster.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/vendor/admix-ui/vendor/libs/easymde/easymde.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/vendor/admix-ui/vendor/libs/easymde/custom.css') }}" rel="stylesheet"/>
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

        [x-cloak] {
            display: none !important;
        }

        /* livewire-tables */
        /* reset .mb-3 */ /* bugou o all columns */
        .before-toolbar div.d-md-flex.justify-content-between.mb-3 {
            margin-bottom: 0 !important;
        }

        .btn.btn-ghost-secondary.btn-sm {
            border-radius: 4px
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .is-invalid .input-group-text {
            border-color: var(--tblr-danger);
            border-top-right-radius: var(--tblr-border-radius) !important;
            border-bottom-right-radius: var(--tblr-border-radius) !important;
        }
    </style>

    {{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ config('app.version') }}">--}}
    {{--    <link rel="apple-touch-icon" href="{{ asset('images/icon-touch.png') }}?v={{ config('app.version') }}">--}}
    {{--    <link rel="icon" href="{{ asset('images/icon-fav.png') }}?v={{ config('app.version') }}">--}}
    {{--    <link rel="manifest" href="{{ asset('json/manifest.json') }}?v={{ config('app.version') }}">--}}
    <livewire:styles/>
    @stack('styles')
</head>
<body class="{{ $bodyClass ?? '' }}">
<script src="{{ asset('/vendor/admix/vendor/tabler/js/theme.min.js') }}" defer></script>
<div class="{{ $pageClass ?? '' }}">
    @yield('aside')
    @yield('header')
    @yield('content')
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

<script src="{{ asset('/vendor/admix/vendor/tabler/libs/fslightbox/index.js') }}" defer></script>
<script src="{{ asset('/vendor/admix/vendor/tabler/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('/vendor/admix/vendor/bootstrap-toaster/js/bootstrap-toaster.min.js') }}" defer></script>
<script src="{{ asset('/vendor/admix-ui/vendor/libs/easymde/easymde.min.js') }}" defer></script>
<livewire:scripts/>

@include('admix::partials.message')

@stack('scripts')

<script>
    /*!
* Tabler v1.0.0-beta17 (https://tabler.io)
* @version 1.0.0-beta17
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
*/
    !function (t) {
        "function" == typeof define && define.amd ? define(t) : t()
    }((function () {
        "use strict";

        function t(t, r) {
            return function (t) {
                if (Array.isArray(t)) return t
            }(t) || function (t, e) {
                var r = null == t ? null : "undefined" != typeof Symbol && t[Symbol.iterator] || t["@@iterator"];
                if (null != r) {
                    var n, o, a, l, i = [], c = !0, u = !1;
                    try {
                        if (a = (r = r.call(t)).next, 0 === e) {
                            if (Object(r) !== r) return;
                            c = !1
                        } else for (; !(c = (n = a.call(r)).done) && (i.push(n.value), i.length !== e); c = !0) ;
                    } catch (t) {
                        u = !0, o = t
                    } finally {
                        try {
                            if (!c && null != r.return && (l = r.return(), Object(l) !== l)) return
                        } finally {
                            if (u) throw o
                        }
                    }
                    return i
                }
            }(t, r) || function (t, r) {
                if (!t) return;
                if ("string" == typeof t) return e(t, r);
                var n = Object.prototype.toString.call(t).slice(8, -1);
                "Object" === n && t.constructor && (n = t.constructor.name);
                if ("Map" === n || "Set" === n) return Array.from(t);
                if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return e(t, r)
            }(t, r) || function () {
                throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
            }()
        }

        function e(t, e) {
            (null == e || e > t.length) && (e = t.length);
            for (var r = 0, n = new Array(e); r < e; r++) n[r] = t[r];
            return n
        }

        for (var r = {
            "menu-position": {localStorage: "tablerMenuPosition", default: "top"},
            "menu-behavior": {localStorage: "tablerMenuBehavior", default: "sticky"},
            "container-layout": {localStorage: "tablerContainerLayout", default: "boxed"}
        }, n = {}, o = 0, a = Object.entries(r); o < a.length; o++) {
            var l = t(a[o], 2), i = l[0], c = l[1], u = localStorage.getItem(c.localStorage);
            n[i] = u || c.default
        }
        !function () {
            for (var t = window.location.search.substring(1).split("&"), e = 0; e < t.length; e++) {
                var o = t[e].split("="), a = o[0], l = o[1];
                r[a] && (localStorage.setItem(r[a].localStorage, l), n[a] = l)
            }
        }();
        var f = document.querySelector("#offcanvasSettings");
        f && (f.addEventListener("submit", (function (e) {
            e.preventDefault(), function (e) {
                for (var o = 0, a = Object.entries(r); o < a.length; o++) {
                    var l = t(a[o], 2), i = l[0], c = l[1],
                        u = e.querySelector('[name="settings-'.concat(i, '"]:checked')).value;
                    localStorage.setItem(c.localStorage, u), n[i] = u
                }
                window.dispatchEvent(new Event("resize")), new bootstrap.Offcanvas(e).hide()
            }(f)
        })), function (e) {
            for (var o = 0, a = Object.entries(r); o < a.length; o++) {
                var l = t(a[o], 2), i = l[0];
                l[1];
                var c = e.querySelector('[name="settings-'.concat(i, '"][value="').concat(n[i], '"]'));
                c && (c.checked = !0)
            }
        }(f))
    }));
</script>
</body>
</html>
