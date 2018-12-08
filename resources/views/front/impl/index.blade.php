@extends('front.layout.app')
{{-- img --}}
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
    @include('front.widget.hotdeal')
    @include('front.widget.newproduct')
    @include('front.widget.top0')

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
                            $.get("{{url('whish/count')}}", function(whish) {
                                $('#whish-qty').html(whish.count);
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
                            //update cart
                            let sumPrice = 0;
                            let sumQty = 0;
                            let storageUrl = "{{url('storage')}}" + "/";
                            let productUrl = "{{url('product')}}" + "/";

                            function getCartList(data) {
                                $('#cart-list').html("");
                                data.forEach(ele => {
                                    let element =`
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="${getUrl(ele.menu.menu_pictures[0].name)}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href=${productUrl+ele.menu.id}>${ele.menu.name}</a></h3>
                                                <h4 class="product-price"><span class="qty">${ele.quantity}x</span>${ele.menu.price} บาท</h4>
                                            </div>
                                            <button class="delete" onclick="removeFromCart(${ele.menu.id}, ${ele.quantity}, '${ele.menu.name}');"><i class="fa fa-close"></i></button>
                                        </div>
                                    `
                                    $('#cart-list').append(element);
                                    sumQty += ele.quantity;
                                    sumPrice += ele.quantity * ele.menu.price;
                                });

                                $('#cart-qty').html(sumQty);
                                $('#cart-sum-qty').html('จำนวนรวม: ' + sumQty + ' ชิ้น');
                                $('#cart-price').html('ราคารวม: ' + sumPrice + ' บาท');
                                sumPrice = 0;
                                sumQty = 0;
                            }

                            $.get("{{url('cart')}}", getCartList);
                        }
                    });
                } else {
                    swal("", {
                        title: "กรุณาเข้าสู่ระบบ",
                        icon: "error"
                    });
                }
            }
        });
    </script>

@endsection
