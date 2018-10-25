@extends('front.layout.app')

@section('content')

    <!-- BREADCRUMB -->
    @yield('breadcrumb')

    <!-- STORE SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    @yield('aside')
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                @yield('store')
                <!-- /STORE -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->
    @yield('news')

@endsection
