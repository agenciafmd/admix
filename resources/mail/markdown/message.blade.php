@component('admix-mail::layout')
    @slot('icon')
        @component('admix-mail::icon', ['color' => $color])
            {{ $icon }}
        @endcomponent
    @endslot

    @slot('greeting')
        @component('admix-mail::greeting')
            {{ $greeting }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('admix-mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
@endcomponent
