<input type="file" name="file" id="{{ $name }}" {{ $attributes->merge(['class' => (($errors->admix->has($name)) ? ' is-invalid' : '') . ' form-control custom-select']) }} />

@push('scripts')
    <script>
        $(function () {
            var el = $("#{{ $name }}");
            el.fileinput({
                theme: "fe",
                language: "pt-BR",
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
                @if ($preview && $download && $uuid)
                initialPreview: ['{{ $preview }}'],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    {
                        caption: '',
                        downloadUrl: '{{ $download }}',
                        size: '',
                        key: '{{ $uuid }}',
                    },
                ],
                @endif
            }).on("filebatchselected", function (event, files) {
                el.fileinput("upload");
            }).on('filebatchuploadsuccess', function (event, data) {
                el.parents('form').append('<input type="hidden" name="media[' + data.response[0].uuid + '][name]" value="' + data.response[0].name + '" />');
                el.parents('form').append('<input type="hidden" name="media[' + data.response[0].uuid + '][collection]" value="' + data.response[0].collection + '" />');
            });
        });
    </script>
@endpush