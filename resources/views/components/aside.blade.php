<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <img src="{{ config('admix.logo.negative') }}" width="110" height="32" alt="logo"
                 class="navbar-brand-image">
        </h1>
        <!-- TODO: hide this item os small screens (<990) -->
        <!--h5 class="navbar-heading text-center text-uppercase text-muted">{{ config('app.name') }}</h5-->

        <x-admix::profile name="{{ auth('admix-web')->user()->name }}"
                          role="Administrador"
                          :to-mobile="true"
        />

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-4">
                @foreach(app()->make('admix-menu')->sortBy('ord') as $item)
                    <x-dynamic-component :component="$item->component"/>
                @endforeach
            </ul>
        </div>
    </div>
</aside>