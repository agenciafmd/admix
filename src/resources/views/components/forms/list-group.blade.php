@isset($title)
    <div id="title-{{ Str::slug($title) }}" class="card-header bg-gray-lightest">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
@endisset

<ul @isset($title) id="item-{{ Str::slug($title) }}" @endisset class="list-group list-group-flush">
    {{ $slot }}
</ul>