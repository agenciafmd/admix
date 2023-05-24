<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <x-admix::profile name="{{ auth('admix-web')->user()->name }}"
                          role="Administrador"
        />

        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                {{--                <form action="./" method="get" autocomplete="off" novalidate="">--}}
                {{--                    <div class="input-icon">--}}
                {{--                  <span class="input-icon-addon">--}}
                {{--                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->--}}
                {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>--}}
                {{--                  </span>--}}
                {{--                        <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">--}}
                {{--                    </div>--}}
                {{--                </form>--}}
            </div>
        </div>
    </div>
</header>