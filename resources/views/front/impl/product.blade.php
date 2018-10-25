@extends('front.layout.app')

@section('content')

    <!-- BREADCRUMB -->
    @yield('breadcrumb')

    {{-- Sections --}}
    @yield('sections')

    <!-- NEWSLETTER -->
    @yield('news')

@endsection
