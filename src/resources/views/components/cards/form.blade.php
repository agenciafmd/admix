<x-admix::forms.form
        action="{{ (request()->is('*/create')) ? $create : (request()->is('*/edit') ? $update : $action) }}"
        method="{{ (request()->is('*/create')) ? 'POST' : (request()->is('*/edit') ? 'PUT' : 'GET') }}">
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">
            @if(request()->is('*/create'))
                Criar
            @elseif(request()->is('*/edit'))
                Editar
            @endif
            {{ Str::ucfirst($title) }}
        </h3>
        <div class="card-options">
            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>

    {{ $slot }}

    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
</x-admix::forms.form>