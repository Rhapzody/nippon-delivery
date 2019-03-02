@extends('back.layout.app')
{{-- img --}}
@section('content')
<style>
    .no-underline:hover {
        text-decoration: none;
    }
</style>
@php
function getUrl($file_name){
    if(env('APP_ENV') == 'production'){
        return env('AWS_URL') . '/public' . '/' . $file_name;
    }else {
        return url('storage', $file_name);
    }
}
@endphp
<h4 class="page-title"><span class="la la-truck"></span> การจัดส่ง</h4>
<div class="row">
    <div class="col-md-12 bg-light border rounded p-2">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card border border-info">
                    <div class="card-header">
                        <div class="card-title">ออเดอร์ที่รอส่ง</div>
                    </div>
                    <div class="card-body">
                        @foreach ($third_orders as $order)
                            <div class="card mb-2 border border-secondary" id="order-{{$order->id}}">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-light" data-toggle="collapse" data-target="#wait-{{$order->id}}">
                                           <span class="pull-left">หมายเลขใบสั่ง: {{$order->id}}</span>
                                           <span class="ml-4"><i class="la la-angle-double-down"></i></span>
                                           <button type="button" class="btn btn-danger pull-right btn-sm" onclick="document.getElementById('waiting-'+{{$order->id}}).submit();">นำส่ง</button>
                                        </button>
                                    </h5>
                                    <form action="{{url('staff/deliver/3to4')}}" method="post" id="{{'waiting-'.$order->id}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$order->id}}">
                                    </form>
                                </div>

                                <div id="wait-{{$order->id}}" class="collapse" >
                                    <div class="card-body">
                                        <span class="pull-left h6">คุณ {{$order->user->first_name . " " . $order->user->last_name}}</span>
                                        <span class="pull-right h6">สั่งเมื่อ {{$order->created_at}}</span>
                                        <table class="table table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ชื่อ</th>
                                                    <th class="text-center">จำนวน</th>
                                                    <th class="text-center">ราคาต่อชิ้น(บาท)</th>
                                                    <th class="text-center">ราคารวม(บาท)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($order->orderMenus as $menu)
                                                    <tr>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->menu->name}}</td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->quantity}}</td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->price}}</td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->quantity * $menu->price}}</td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>ที่อยู่ที่จัดส่ง: </div>
                                                <div>{{$order->address}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                @php
                                                    $menus = $order->orderMenus;
                                                    $status = $order->orderStatus;
                                                    $sum_qty = 0;
                                                    $sum_price = 0;
                                                    $ship_cost = $order->shipping_cost;
                                                    foreach ($menus as $key => $value) {
                                                        $sum_qty += $value->quantity;
                                                        $sum_price += $value->price * $value->quantity;
                                                    }
                                                @endphp
                                                <div>จำนวนทั้งหมด: <span class="pull-right">{{$sum_qty}} ชิ้น</span></div>
                                                <div>ราคารวม: <span class="pull-right">{{$sum_price}} บาท</span></div>
                                                <div>ค่าจัดส่ง: <span class="pull-right">{{$ship_cost}} บาท</span></div>
                                                <div>รวมทั้งสิ้น: <span class="pull-right">{{$ship_cost + $sum_price}} บาท</span></div>
                                                <button class="btn btn-primary pull-right mt-2" onclick="printDiv('order-{{$order->id}}')">
                                                    <span> พิมพ์</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card border border-danger">
                    <div class="card-header">
                        <div class="card-title">ออเดอร์ที่กำลังส่ง</div>
                    </div>
                    <div class="card-body">
                        @foreach ($fourth_orders as $order)
                            <div class="card mb-2 border border-secondary" id="order-{{$order->id}}">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-light" data-toggle="collapse" data-target="#deliver-{{$order->id}}">
                                           <span class="pull-left">หมายเลขใบสั่ง: {{$order->id}}</span>
                                           <span class="ml-4"><i class="la la-angle-double-down"></i></span>
                                           <button type="button" class="btn btn-danger pull-right btn-sm" onclick="document.getElementById('delivery-'+{{$order->id}}).submit();">เสร็จ</button>
                                        </button>
                                    </h5>
                                    <form action="{{url('staff/deliver/4to5')}}" method="post" id="{{'delivery-'.$order->id}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$order->id}}">
                                    </form>
                                </div>

                                <div id="deliver-{{$order->id}}" class="collapse" >
                                    <div class="card-body">
                                        <span class="pull-left h6">คุณ {{$order->user->first_name . " " . $order->user->last_name}}</span>
                                        <span class="pull-right h6">สั่งเมื่อ {{$order->created_at}}</span>

                                        <table class="table table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ชื่อ</th>
                                                    <th class="text-center">จำนวน</th>
                                                    <th class="text-center">ราคาต่อชิ้น(บาท)</th>
                                                    <th class="text-center">ราคารวม(บาท)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($order->orderMenus as $menu)
                                                    <tr>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->menu->name}}</td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->quantity}}</td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->price}}</td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->quantity * $menu->price}}</td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>ที่อยู่ที่จัดส่ง: </div>
                                                <div>{{$order->address}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                @php
                                                    $menus = $order->orderMenus;
                                                    $status = $order->orderStatus;
                                                    $sum_qty = 0;
                                                    $sum_price = 0;
                                                    $ship_cost = $order->shipping_cost;
                                                    foreach ($menus as $key => $value) {
                                                        $sum_qty += $value->quantity;
                                                        $sum_price += $value->price * $value->quantity;
                                                    }
                                                @endphp
                                                <div>จำนวนทั้งหมด: <span class="pull-right">{{$sum_qty}} ชิ้น</span></div>
                                                <div>ราคารวม: <span class="pull-right">{{$sum_price}} บาท</span></div>
                                                <div>ค่าจัดส่ง: <span class="pull-right">{{$ship_cost}} บาท</span></div>
                                                <div>รวมทั้งสิ้น: <span class="pull-right">{{$ship_cost + $sum_price}} บาท</span></div>
                                                <button class="btn btn-primary pull-right mt-2" onclick="printDiv('order-{{$order->id}}');">
                                                    <span> พิมพ์</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('{{Auth::user()->sub_district_id}}');
    channel.bind('my-event', function(data) {
        if (data.message === 'refresh') {
            location.reload();
        }
    });
</script>
@endsection
