<x-admix::forms.list-item>
    <x-slot name="label">
        <x-admix::forms.label label="{{ $label }}" for="{{ $for }}"/>
    </x-slot>

    {{ $slot }}

    @isset($help)
        <x-slot name="help">
            {{ $help }}
        </x-slot>
    @endisset

    <x-admix::forms.invalid-feedback label="{{ $label }}" name="{{ $for }}"/>
</x-admix::forms.list-item>
