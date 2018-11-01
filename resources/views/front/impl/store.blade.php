@extends('front.layout.app')

@section('content')

    @if ($searching == true)
        @include('front.widget.breadcrumb', ['header'=>'ผลการค้นหา '. ': ' . $search])
    @endif

    <!-- STORE SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                @include('front.widget.store-aside')

                <!-- STORE -->
                @include('front.widget.store')
                <!-- /STORE -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let addWhishList;
        let addToCart;
        let isAuth;
        $(function() {
            isAuth = $('meta[name="auth-check"]').attr('content');
            console.log('Auth status : ' + isAuth);

            addWhishList = function(id) {
                if (isAuth) {
                    $.post("{{url('whish/add')}}" + "/" + id,{
                        _token:"{{csrf_token()}}"
                    },function (data,status) {
                        if(data.status === "success"){
                            swal("เพิ่มสินค้าในรายการที่ชอบแล้ว", {
                                icon: "success"
                            });
                        }else{
                            swal("สินค้านี้เพิ่มในรายการที่ชอบไปแล้ว", {
                                icon: "error"
                            });
                        }
                    });
                } else {
                    swal("", {
                        title: "กรุณาเข้าสู่ระบบ",
                        icon: "error"
                    });
                }
            }

            addToCart = function(id, qt) {
                if (isAuth) {
                    $.post("{{url('cart/add')}}" + "/" + id,{
                        quantity:qt,
                        _token:"{{csrf_token()}}"
                    },function (data,status) {
                        if(data.status === "success"){
                            swal("เพิ่มสินค้าในตะกร้าแล้ว", {
                                icon: "success"
                            });
                        }
                    });
                } else {
                    swal("", {
                        title: "กรุณาเข้าสู่ระบบ",
                        icon: "error"
                    });
                }
            }

            //count down

        });
    </script>

@endsection
