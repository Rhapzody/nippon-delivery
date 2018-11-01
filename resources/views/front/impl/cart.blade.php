@section('content')

    <!-- BREADCRUMB -->
    @include('front.widget.breadcrumb',[
        'header'=>$header
    ])

    <div class="section">
        <div class="container">
            <div class="row">
                <div id="aside" class="col-md-3">
                    {{-- Nav user --}}
                    @include('front.widget.nav-user',[

                    ])
                </div>
                <div id="store" class="col-md-9">
                    {{-- content --}}
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

@endsection
