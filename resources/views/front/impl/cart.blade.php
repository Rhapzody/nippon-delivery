@extends('front.layout.app')

@section('content')
<!-- BREADCRUMB -->
@include('front.widget.breadcrumb',[
'header'=>$header
])
@php
    function getUrl($file_name){
        if(env('APP_ENV') == 'production'){
            return env('AWS_URL') . '/public' . '/' . $file_name;
        }else {
            return url('storage', $file_name);
        }
    }
@endphp
<div class="section">
    <div class="container">
        <div class="row">
            <div id="aside" class="col-md-3">
                {{-- Nav user --}}
                @include('front.widget.nav-user',[

                ])
            </div>
            <div id="store" class="col-md-9">
                @if ($is_cart_empty == true)
                    <h1>ไม่มีสินค้าอยู่ในตะกร้า</h1>
                @else
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">ชื่อ</th>
                                <th class="text-center">จำนวน</th>
                                <th class="text-center">ราคาต่อชิ้น(บาท)</th>
                                <th class="text-center">ราคารวม(บาท)</th>
                                <th class="text-center">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><img src="{{ getUrl($menu->menu->menuPictures[0]->name) }}" alt="" width="50px" height="50px"></td>
                                    <td style="vertical-align: middle;" class="text-center"><a href={{url('product',[$menu->menu_id])}}>{{$menu->menu->name}}</a></td>
                                    <td style="vertical-align: middle;" class="text-center">{{$menu->quantity}}</td>
                                    <td style="vertical-align: middle;" class="text-center">{{$menu->menu->price}}</td>
                                    <td style="vertical-align: middle;" class="text-center">{{$menu->quantity * $menu->menu->price}}</td>
                                    <td>
                                        <button onclick="downQty({{$menu->menu->id}}, {{$menu->quantity}}, '{{$menu->menu->name}}');" title="ลด" type="button" class="primary-btn order-submit btn-sm">
                                            <span class="fa fa-minus-circle" style="font-size:150%"></span>
                                        </button>
                                        <button onclick="upQty({{$menu->menu->id}}, {{$menu->quantity}}, '{{$menu->menu->name}}');" title="เพิ่ม" type="button" class="primary-btn order-submit btn-sm">
                                            <span class="fa fa-plus-circle" style="font-size:150%"></span>
                                        </button>
                                        <button onclick="deleteList({{$menu->menu->id}}, {{$menu->quantity}}, '{{$menu->menu->name}}')" title="ลบ" type="button" class="primary-btn order-submit btn-sm">
                                            <span class="fa fa-trash" style="font-size:150%"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <h1>ไม่มีสินค้าอยู่ในตะกร้า</h1>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-6">
                            <h4>จำนวนทั้งหมด: <span class="pull-right">{{$sum_qty}} ชิ้น</span></h4>
                            <h4>ราคารวม: <span class="pull-right">{{$sum_price}} บาท</span></h4>
                            <h4>ค่าจัดส่ง: <span class="pull-right">{{$ship_cost}} บาท</span></h4>
                            <h4>รวมทั้งสิ้น: <span class="pull-right">{{$ship_cost + $sum_price}} บาท</span></h4>
                            <form action="{{url('user/checkout?unav=check')}}" method="POST">
                                @csrf
                                <button class="primary-btn order-submit pull-right" type="submit">
                                    <span class="fa fa-arrow-circle-o-right" style="font-size:170%"> ดำเนินการต่อ</span>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($is_cart_empty != true)
    <script>
        let upQty;
        let downQty;
        let deleteList;
        $(function() {
            downQty = function (id, qty, name) {
                swal({
                    title: 'ลบรายการ "' + name +'"',
                    text: 'กรุณาระบุจำนวนที่ต้องการลบ',
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "จำนวนที่ต้องการลด 1 - " + qty,
                            type: "number",
                            min:0,
                            max:qty
                        },
                    },
                    button: {
                        text:"ลบ"
                    },
                })
                .then(input => {
                    if (input >= qty) {
                        input = qty;
                    }else if (input == 0 || input == null || input < 0) {
                        return false;
                    }

                    $.post("{{url('cart/delete')}}" + "/" + id, {
                        quantity:input,
                        _token:"{{csrf_token()}}"
                    },function(data) {
                        if (data.status === 'success') {
                            swal("ลบสำเร็จ", "ลบ " + name + " จำนวน " + input + " ชิ้น", "success");
                            location.reload();
                        }else{
                            swal("ลบไม่สำเร็จ", "มีข้อผิดพลาดบางประการ", "error");
                        }
                    });
                });
            }

            upQty = function (id, qty, name) {
                swal({
                    title: 'เพิ่มรายการ "' + name +'"',
                    text: 'กรุณาระบุจำนวนที่ต้องการเพิ่ม',
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "จำนวนที่ต้องการเพิ่ม",
                            type: "number",
                            min:0
                        },
                    },
                    button: {
                        text:"เพิ่ม"
                    },
                })
                .then(input => {
                    if (input == 0 || input == null || input < 0) {
                        return false;
                    }

                    $.post("{{url('cart/plus')}}" + "/" + id, {
                        quantity:input,
                        _token:"{{csrf_token()}}"
                    },function(data) {
                        if (data.status === 'success') {
                            swal("เพิ่มสำเร็จ", "เพิ่ม " + name + " จำนวน " + input + " ชิ้น", "success");
                            location.reload();
                        }else{
                            swal("เพิ่มไม่สำเร็จ", "มีข้อผิดพลาดบางประการ", "error");
                        }
                    });
                });
            }

            deleteList = function(id, qty, name) {
                swal({
                    title: "แน่ใจหรือไม่?",
                    text: "ต้องการจะลบ " + name + " ออกจากตะกร้าใช่หรือไม่?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post("{{url('cart/delete')}}" + "/" + id, {
                            quantity:qty,
                            _token:"{{csrf_token()}}"
                        },function(data) {
                            if (data.status === 'success') {
                                swal("ลบสำเร็จ", "ลบ " + name, "success");
                                location.reload();
                            }else{
                                swal("ลบไม่สำเร็จ", "มีข้อผิดพลาดบางประการ", "error");
                            }
                        });
                    }
                });
            }

        });
    </script>
@endif

@endsection
