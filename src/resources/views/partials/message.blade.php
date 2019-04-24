{{-- overkill --}}
@php
    header('Cache-Control: no-store, private, no-cache, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Expires: 0', false);
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Pragma: no-cache');
@endphp

@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('agenciafmd/flash::partials.modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div style="position: absolute; top: 1rem; right: 1rem;">
            <div class="alert alert-{{ ($message['level']) ? $message['level'] : 'info' }} alert-dismissible fake-toast fade hide"
                 data-autohide="true" data-delay="6000">
                <button data-dismiss="alert" class="close"></button>
                <h4>{{ ($message['title']) ? $message['title'] : 'Atenção' }}</h4>
                {!! $message['message'] !!}
            </div>
        </div>

        <script>
            $(function () {
                $('.fake-toast').toast('show');
            });
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}