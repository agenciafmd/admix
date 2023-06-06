<div class="page-wrapper">
    <x-page.header>
        {{ __('User') }}
        <x-slot:actions>
            {{--        <div class="col-auto ms-auto d-print-none">--}}
            {{--            <div class="d-flex">--}}
            {{--                <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…">--}}
            {{--                <a href="#" class="btn btn-primary">--}}
            {{--                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->--}}
            {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>--}}
            {{--                    New user--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--        </div>--}}
        </x-slot:actions>
    </x-page.header>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                {{--                <div class="card-body">--}}
                <livewire:admix::user.table/>
                {{--                </div>--}}
            </div>
        </div>
    </div>
</div>
