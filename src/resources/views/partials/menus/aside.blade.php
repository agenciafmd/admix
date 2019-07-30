<aside class="navbar navbar-side navbar-fixed js-sidebar navbar-dark">
    <div class="pb-3">
        <a class="navbar-brand text-inherit">
            <img src="/images/fmd.svg" alt="" class="hide-navbar-folded navbar-brand-logo">
        </a>
    </div>
    <div class="flex-fill">
        <h6 class="navbar-heading text-center">
            Administrativo
        </h6>
        <ul class="navbar-nav mb-md-4 mt-8" id="menu">
            @foreach(app()->make('admix-menu')->sortBy('ord') as $view)
                @include($view->view)
            @endforeach
        </ul>
    </div>
</aside>