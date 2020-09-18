<input type="file" name="file[]" multiple
       id="{{ $name }}" {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control custom-select']) }} />

@push('scripts')
    <script>
        $(function () {
            var el = $("#{{ $name }}");
            el.fileinput({
                theme: "fe",
                language: "pt-BR",
                overwriteInitial: false,
                uploadExtraData: function (previewId, index) {
                    return {
                        key: index,
                        collection: '{{ $name }}',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                },
                maxImageWidth: '{{ $width*1.2 }}', /* aceita 20% além do máximo permitido */
                maxImageHeight: '{{ $height*1.2 }}',
                resizeImage: true,
                resizeImageQuality: '{{ number_format($quality/100, 2, '.', '') }}',
                fileActionSettings: {
                    showDrag: true,
                },
                @if ($preview->count() > 0)
                initialPreview: ['{!! $preview->map(fn($item) => asset($item->getUrl($conversion)))->implode("', '") !!}'],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    @foreach($preview as $item)
                    {
                        caption: '{{ $item->name }}',
                        downloadUrl: '{{ asset($item->getUrl($conversion)) }}',
                        size: '{{ $item->size }}',
                        key: '{{ $item->getCustomProperty('uuid') }}'
                    },
                    @endforeach
                ],
                @endif
            }).on('filesorted', function (e, params) {
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.post('{{ route('admix.upload.sort') }}', {_token: _token, stack: params.stack});
            }).on("filebatchselected", function (event, files) {
                el.fileinput("upload");
            }).on('filebatchuploadsuccess', function (event, data) {
                for (i = 0; i < data.response.length; i++) {
                    el.parents('form').append('<input type="hidden" name="media[' + data.response[i].uuid + '][name][' + i + ']" value="' + data.response[i].name + '" />');
                    el.parents('form').append('<input type="hidden" name="media[' + data.response[i].uuid + '][collection][' + i + ']" value="' + data.response[i].collection + '" />');
                }
            });
        });
    </script>
@endpush