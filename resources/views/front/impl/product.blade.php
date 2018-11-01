@extends('front.layout.app')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}" style="font-size:18px;">หน้าแรก</a></li>
                        <li><a href="{{url('store', [$product->menuType->name])}}" style="font-size:18px;">{{$product->menuType->name}}</a></li>
                        <li><a href="#" style="font-size:18px;">{{$product->name}}</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    @include('front.widget.product')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let addWhishList;
        let addToCart;
        let isAuth;
        let getQty;
        $(function() {
            isAuth = $('meta[name="auth-check"]').attr('content');


            getQty = function() {
                if($('#qty').val() >= 1) return $('#qty').val();
                else{
                    $('#qty').val(1);
                    return 1;
                }
            }

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
