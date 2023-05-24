@extends('admix::master', [
    'bodyClass' => 'layout-fluid',
    'pageClass' => 'page',
])

@section('aside')
    <x-admix::aside/>
@endsection

@section('header')
    <x-admix::header/>
@endsection

@section('content')
    @yield('internal-content')
@endsection