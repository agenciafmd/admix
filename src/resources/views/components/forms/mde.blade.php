@props(['name', 'options' => []])
<x-easy-mde
        :name="$name"
        :options="array_merge(['minHeight' => '400px', 'spellChecker' => false, 'toolbar' => ['bold', 'italic', 'strikethrough', '|', 'link', 'table', '|', 'preview', 'side-by-side', 'fullscreen', '|', 'guide']], $options)"
        rows="9"
        {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control ']) }}
>{{ $slot ?? null }}</x-easy-mde>