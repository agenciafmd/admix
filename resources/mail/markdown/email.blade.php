@component('admix-mail::markdown.message')
<?php
    $level = ($level) ?? 'default';
    $introLines = ($introLines) ?? [];

    switch ($level) {
        case 'success':
            $color = 'green';
            $icon ??= 'check-circle';
            break;
        case 'error':
            $color = 'red';
            $icon ??= 'x-circle';
            break;
        case 'warning':
            $color = 'yellow';
            $icon ??= 'alert-triangle';
            break;
        case 'info':
            $color = 'blue';
            $icon ??= 'info';
            break;
        default:
            $color = 'gray';
            $icon ??= 'mail';
    }
?>

@slot('color')
{{ $color }}
@endslot

@slot('icon')
{{ $icon }}
@endslot

@if (!empty($greeting))
@slot('greeting')
{{ $greeting }}
@endslot
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
@component('admix-mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Subcopy --}}
@isset($actionText)
@component('admix-mail::subcopy')
Caso encontre problemas clicando no botão "{{ $actionText }}", copie e cole a URL abaixo no seu navegador:
[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
