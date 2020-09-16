<select {{ $attributes->except(['options', 'selected']) }} name="{{ $name }}">
    @foreach($options as $value => $label)
        <option {{ $isSelected($value) ? 'selected=selected' : '' }} value="{{ $value }}">
            {{ $label }}
        </option>
    @endforeach
</select>