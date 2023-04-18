<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta content="telephone=no" name="format-detection" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<title>{{ config('app.name') }}</title>
<style type="text/css" data-premailer="ignore">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700);
</style>
<style data-premailer="ignore">
    @media screen and (max-width: 600px) {
        u+.body {
            width: 100vw !important;
        }
    }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
</style>
<!--[if mso]>
<style type="text/css">
    body, table, td {
        font-family: Arial, Helvetica, sans-serif !important;
    }

    img {
        -ms-interpolation-mode: bicubic;
    }

    .box {
        border-color: #eee !important;
    }
</style>
<![endif]-->
</head>

{{--<head>--}}
{{--<title>{{ config('app.name') }}</title>--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1.0" />--}}
{{--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />--}}
{{--<meta name="color-scheme" content="light">--}}
{{--<meta name="supported-color-schemes" content="light">--}}
{{--<style>--}}
{{--@media only screen and (max-width: 600px) {--}}
{{--.inner-body {--}}
{{--width: 100% !important;--}}
{{--}--}}

{{--.footer {--}}
{{--width: 100% !important;--}}
{{--}--}}
{{--}--}}

{{--@media only screen and (max-width: 500px) {--}}
{{--.button {--}}
{{--width: 100% !important;--}}
{{--}--}}
{{--}--}}
{{--</style>--}}
{{--</head>--}}
<body class="bg-body">
<center>
    <table class="main bg-body" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="top">
                <!--[if (gte mso 9)|(IE)]>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" valign="top" width="640">
                <![endif]-->
                <span class="preheader">{{ Str::of($greeting)->stripTags()->squish() }}</span>
                <table class="wrap" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="p-sm">
                            @include('admix-mail::header')

                            <div class="main-content">
                                <table class="box" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td class="content pb-0" align="center">
                                                        {{-- $title ?? '' --}}
{{--                                                        <table class="icon icon-lg bg-blue-lightest " cellspacing="0" cellpadding="0">--}}
{{--                                                            <tr>--}}
{{--                                                                <td valign="middle" align="center">--}}
{{--                                                                    <img src="./assets/icons-blue-unlock.png" class=" va-middle" width="40" height="40" alt="unlock" />--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        </table>--}}
                                                        {{ $icon ?? '' }}

                                                        {{ $greeting ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="content text-center">

                                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

{{--                                                        <p>You recently requested to reset a password for your Tabler account. Use the button below to reset it. This message will expire in 24 hours.</p>--}}
                                                    </td>
                                                </tr>
{{--                                                <tr>--}}
{{--                                                    <td class="content text-center pt-0 pb-xl">--}}
{{--                                                        <table cellspacing="0" cellpadding="0">--}}
{{--                                                            <tr>--}}
{{--                                                                <td align="center">--}}
{{--                                                                    <table cellpadding="0" cellspacing="0" border="0" class="bg-blue rounded w-auto">--}}
{{--                                                                        <tr>--}}
{{--                                                                            <td align="center" valign="top" class="lh-1">--}}
{{--                                                                                <a href="https://tabler.io/emails?utm_source=demo" class="btn bg-blue border-blue">--}}
{{--                                                                                    <span class="btn-span">Reset&nbsp;password</span>--}}
{{--                                                                                </a>--}}
{{--                                                                            </td>--}}
{{--                                                                        </tr>--}}
{{--                                                                    </table>--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        </table>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
                                                <tr>
                                                    <td>
                                                        {{ $subcopy ?? '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            @include('admix-mail::footer')
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
    </table>
</center>
</body>

<!--------- ------------------->
{{--<body>--}}
{{--<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">--}}
{{--<tr>--}}
{{--<td align="center">--}}
{{--<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">--}}
{{--{{ $header ?? '' }}--}}

{{--<!-- Email Body -->--}}
{{--<tr>--}}
{{--<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">--}}
{{--<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">--}}
{{--<!-- Body content -->--}}
{{--<tr>--}}
{{--<td class="content-cell">--}}
{{--{{ Illuminate\Mail\Markdown::parse($slot) }}--}}

{{--{{ $subcopy ?? '' }}--}}
{{--</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--</td>--}}
{{--</tr>--}}

{{--{{ $footer ?? '' }}--}}
{{--</table>--}}
{{--</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--</body>--}}
</html>
