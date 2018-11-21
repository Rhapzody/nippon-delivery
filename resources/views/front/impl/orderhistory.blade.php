@extends('front.layout.app')

@section('content')
<link href="{{url('css/progress-wizard.min.css')}}" rel="stylesheet">
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
                <div class="row">
                    <div class="col-md-6">
                        <h4>ใบสั่งซื้อ หมายเลข: {{$order->id}}</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>{{$order->created_at}}</h4>
                    </div>
                </div>
                <div class="row" style="padding-top:20px; padding-bottom:20px; font-size:200%">
                    <div class="col-md-12">
                        <ul class="progress-indicator">
                            <li class="{{($order->status_code>=1)?'completed':''}}">
                                <span class="bubble"></span><span class="fa fa-file-text "></span> รอเข้าครัว
                            </li>
                            <li class="{{($order->status_code>=2)?'completed':''}}">
                                <span class="bubble"></span><span class="fa fa-fire"></span> กำลังปรุง
                            </li>

                            <li class="{{($order->status_code>=3)?'completed':''}}">
                                <span class="bubble"></span><span class="fa fa-archive"></span> เสร็จแล้ว
                            </li>
                            <li class="{{($order->status_code>=4)?'completed':''}}">
                                <span class="bubble"></span><span class="fa fa-truck"></span> กำลังจัดส่ง
                            </li>
                            <li class="{{($order->status_code>=5)?'completed':''}}">
                                <span class="bubble"></span><span class="fa fa-cutlery"></span> ส่งถึงแล้ว
                            </li>
                        </ul>
                    </div>
                </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><img src={{url('storage',[$menu->menu->menuPictures->first()->name])}} alt="" width="50px" height="50px"></td>
                                    <td style="vertical-align: middle;" class="text-center"><a href={{url('product',[$menu->menu_id])}}>{{$menu->menu->name}}</a></td>
                                    <td style="vertical-align: middle;" class="text-center">{{$menu->quantity}}</td>
                                    <td style="vertical-align: middle;" class="text-center">{{$menu->menu->price}}</td>
                                    <td style="vertical-align: middle;" class="text-center">{{$menu->quantity * $menu->menu->price}}</td>
                                </tr>
                            @empty
                                <h1>ไม่มีสินค้าอยู่ในตะกร้า</h1>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ที่อยู่ที่จัดส่ง: </h4>
                            <h4>{{$order->address}}</h4>
                        </div>
                        <div class="col-md-6">
                            <h4>จำนวนทั้งหมด: <span class="pull-right">{{$sum_qty}} ชิ้น</span></h4>
                            <h4>ราคารวม: <span class="pull-right">{{$sum_price}} บาท</span></h4>
                            <h4>ค่าจัดส่ง: <span class="pull-right">{{$ship_cost}} บาท</span></h4>
                            <h4>รวมทั้งสิ้น: <span class="pull-right">{{$ship_cost + $sum_price}} บาท</span></h4>
                            <button class="primary-btn order-submit pull-right" onclick="window.history.back();">
                                <span class="fa fa-arrow-circle-o-left" style="font-size:170%"> กลับ</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
