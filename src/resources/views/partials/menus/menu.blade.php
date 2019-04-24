<ul class="list-unstyled components">
    <p class="text-center">Administrativo</p>
    @foreach(app()->make('admix-menu')->sortBy('ord') as $view)
        @include($view->view)
    @endforeach
</ul>