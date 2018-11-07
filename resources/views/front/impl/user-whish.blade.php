@extends('front.layout.app')

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
                    @include('front.widget.whish-product')
            </div>

        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    let delWhishList;
    let addToCart;
    let isAuth;
    $(function() {
        isAuth = $('meta[name="auth-check"]').attr('content');

        delWhishList = function(id) {
            swal({
                title: "แน่ใจหรือไม่",
                text: "ต้องการจะลบเมนูนี้ออกจากรายการที่ชอบหรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                    if (willDelete) {
                        $.post("{{url('whish/delete')}}" + "/" + id,{
                        _token:"{{csrf_token()}}"
                    },function (data,status) {
                        if(data.status === "success"){
                            swal("ลบเมนูออกจากรายการที่ชอบแล้ว", {
                                icon: "success"
                            });
                            location.reload();
                        }
                    });
                }
            });
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
                                            <img src=${storageUrl+ele.menu.menu_pictures[0].name} alt="">
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

        //count down

    });


</script>

@endsection
