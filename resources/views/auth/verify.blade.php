@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('ลิงก์สำหรับยืนยันตัวตนถูกส่งไปที่อีเมลของท่านเรียบร้อยแล้ว') }}
                        </div>
                    @endif

                    {{ __('กรุณายืนยันอีเมลของคุณ ') }}
                    {{ __('ถ้ายังไม่ได้รับอีเมล') }}, <a href="{{ route('verification.resend') }}">{{ __('คลิกที่นี่เพื่อส่งอีกครั้ง') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
