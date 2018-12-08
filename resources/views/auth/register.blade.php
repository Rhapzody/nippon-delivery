@extends('front.layout.app')


@section('content')

    @php
        function getUrl($file_name){
            if(env('APP_ENV') == 'production'){
                return env('AWS_URL') . '/public' . '/' . $file_name;
            }else {
                return url('storage', $file_name);
            }
        }
    @endphp
    @include('front.widget.breadcrumb',[
        'header'=>'สมัครสมาชิก'
    ])
    @include('front.widget.addressform')

@endsection
