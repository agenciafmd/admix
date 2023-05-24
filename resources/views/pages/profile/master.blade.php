@extends('admix::internal')

@section('internal-content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __('Settings') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-3 d-none d-md-block border-end">
                            <div class="card-body">
                                <h4 class="subheader">{{ __('Settings') }}</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="{{ route('admix.profile') }}"
                                            @class([
                                                 'list-group-item',
                                                 'list-group-item-action',
                                                 'd-flex',
                                                 'align-items-center',
                                                 'active' => Route::currentRouteName() === 'admix.profile'
                                             ])
                                    >{{ __('My Account') }}</a>
                                    <a href="{{ route('admix.profile.change-password') }}"
                                            @class([
                                                'list-group-item',
                                                'list-group-item-action',
                                                'd-flex',
                                                'align-items-center',
                                                'active' => Route::currentRouteName() === 'admix.profile.change-password'
                                             ])
                                    >{{ __('Change Password') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex flex-column">
                            @yield('profile-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection