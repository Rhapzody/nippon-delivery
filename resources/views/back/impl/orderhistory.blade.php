@extends('back.layout.app')

@section('content')
<link href="{{url('css/progress-wizard.min.css')}}" rel="stylesheet">
<h4 class="page-title"><span class="la la-clipboard"></span> ประวัติการสั่งซื้อ</h4>
<div class="row">
    <div class="col-md-12 bg-light border rounded p-2">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h6>ใบสั่งซื้อ หมายเลข: {{$order->id}}</h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <h6>{{$order->created_at}}</h6>
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
                                    <h6>ที่อยู่ที่จัดส่ง: </h6>
                                    <h6>{{$order->address}}</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>จำนวนทั้งหมด: <span class="pull-right">{{$sum_qty}} ชิ้น</span></h6>
                                    <h6>ราคารวม: <span class="pull-right">{{$sum_price}} บาท</span></h6>
                                    <h6>ค่าจัดส่ง: <span class="pull-right">{{$ship_cost}} บาท</span></h6>
                                    <h6>รวมทั้งสิ้น: <span class="pull-right">{{$ship_cost + $sum_price}} บาท</span></h6>
                                    <button class="btn btn-danger pull-right" onclick="window.history.back();">
                                        <span class="fa fa-arrow-circle-o-left" style="font-size:170%"> กลับ</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>

</script>
@endsection

