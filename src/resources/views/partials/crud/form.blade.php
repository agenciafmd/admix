@extends('agenciafmd/admix::master')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            @yield('form')
        </div>
    </div>
@endsection