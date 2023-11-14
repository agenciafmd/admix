<script>
    window.livewire.on('toast', (param) => {
        localToast(param);
    });

    window.livewire.on('datalayer', (param) => {
        const defaultDataLayerOptions = {
            event: param.event || 'gaEvent',
            action: param.action || 'success',
            details: param.message || 'Formulário Disparado!',
            form_name: param.form_name || 'Contato',
            form_id: param.form_id || '00000',
        };
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            ...defaultDataLayerOptions,
            ...param,
        });
    });

    window.livewire.on('refreshPlugins', (param) => {
        console.log('refresh');
        refreshFsLightbox();
    });

    function localToast(param) {
        param.level = param.level || 'info';
        const type = {
            success: {
                title: 'Sucesso',
                status: TOAST_STATUS.SUCCESS,
            },
            danger: {
                title: 'Falhou',
                status: TOAST_STATUS.DANGER,
            },
            warning: {
                title: 'Atenção',
                status: TOAST_STATUS.WARNING,
            },
            info: {
                title: 'Informação',
                status: TOAST_STATUS.INFO,
            },
        };

        Toast.enableTimers(TOAST_TIMERS.DISABLED);
        Toast.create({
            title: type[param.level]['title'],
            status: type[param.level]['status'],
            message: param.message,
            timeout: 5000
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('flash_notification', collect([]))->count())
            localToast({
                level: '{{ session('flash_notification')['level'] }}',
                message: '{!! session('flash_notification')['message'] !!}',
            });
        @elseif (session()->get('errors'))
            @if(collect(session()->get('errors'))->flatten()->first()->has('hp_time'))
                localToast({
                    level: 'info',
                    message: '{{ __('Por favor, aguarde alguns segundos para enviar os dados.') }}',
                });
            @endif
        @endif
    });
</script>

{{ session()->forget('flash_notification') }}
