@extends('back.layout.app')
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
<h4 class="page-title"><span class="la la-file-text"></span> การสั่งซื้อ</h4>
<div class="row">
    <div class="col-md-12 bg-light border rounded pt-4">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">ภายในตำบล</div>
                    </div>
                    <div class="card-body">
                        <div class="row px-3">
                            <div class="card col-md-5 border-primary pb-2">
                                <div class="card-header">กำลังรอ</div>
                                <div class="card-body">
                                    <div class="list-group">
                                        @foreach ($first_orders as $order)
                                            <div class="list-group-item">
                                                <span data-toggle="tooltip" data-placement="bottom" title="{{$order->address}}">ออเดอร์หมายเลข: {{$order->id}}</span>
                                                @if (Auth::user()->sub_district_id != $order->sub_district_id)
                                                    <button class="btn btn-danger pull-right btn-sm mr-1" onclick="document.getElementById('return-'+{{$order->id}}).submit();">ยกเลิก</button>
                                                @endif
                                                <button class="btn btn-primary pull-right btn-sm mr-1" onclick="document.getElementById('waiting-'+{{$order->id}}).submit();">เข้าครัว</button>
                                            </div>
                                            <form action="{{url('staff/order/1to2')}}" method="post" id="{{'waiting-'.$order->id}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                            </form>
                                            <form action="{{url('staff/order/return')}}" method="post" id="{{'return-'.$order->id}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                            </form>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-6 border-warning pb-2 ml-5">
                                <div class="card-header">กำลังปรุง</div>
                                <div class="card-body">
                                    <div class="list-group">
                                        @foreach ($second_orders as $order)
                                            {{-- start --}}
                                            <a href="#" data-toggle="collapse" data-target="#demo-{{$order->id}}" class="list-group-item">
                                                <span>ออเดอร์หมายเลข: {{$order->id}}</span>
                                                <button onclick="document.getElementById('cooking-'+{{$order->id}}).submit();" class="btn btn-primary pull-right btn-sm inline">เสร็จ</button>
                                            </a>

                                            <ul id="demo-{{$order->id}}" class="collapse mt-1">
                                                @foreach ($order->orderMenus as $menu)
                                                    <li><a href={{url('product',[$menu->menu_id])}}>รหัสสินค้า: {{$menu->menu->id}} - {{$menu->menu->name}}</a> <span class="pull-right">x {{$menu->quantity}} ชิ้น</span></li>
                                                @endforeach
                                            </ul>
                                            <form action="{{url('staff/order/2to3')}}" method="post" id="{{'cooking-'.$order->id}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                            </form>
                                            {{-- end --}}
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">นอกตำบล</div>
                    </div>
                    <div class="card-body">

                        <div class="col-md-1"></div>

                        <div class="card col-md-12 border-success pb-2">
                            <div class="card-header">อำเภอเดียวกัน</div>
                            <div class="card-body">
                                <div class="list-group">
                                    @foreach ($district_orders as $order)
                                        <div class="list-group-item">
                                            <div>ออเดอร์หมายเลข: {{$order->id}} | ที่อยู่: {{$order->address}} | เบอร์โทร: {{$order->user->tel_number}}</div>
                                            <br>
                                            <button class="btn btn-success pull-right btn-sm  mx-1" onclick="document.getElementById('district-'+{{$order->id}}).submit();">รับ</button>
                                            <button class="btn btn-danger pull-right btn-sm" onclick="document.getElementById('cdistrict-'+{{$order->id}}).submit();">ยกเลิก</button>
                                        </div>
                                        <form action="{{url('staff/order/addToBranch')}}" method="post" id="{{'district-'.$order->id}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                        </form>
                                        <form action="{{url('staff/order/cancle')}}" method="post" id="{{'cdistrict-'.$order->id}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                        </form>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>

                        <div class="card col-md-12 border-success pb-2">
                            <div class="card-header">จังหวัดเดียวกัน</div>
                            <div class="card-body">
                                <div class="list-group">

                                    @foreach ($province_orders as $order)
                                        <div class="list-group-item">
                                            <span>ออเดอร์หมายเลข: {{$order->id}} | ที่อยู่: {{$order->address}} | เบอร์โทร: {{$order->user->tel_number}}</span>
                                            <br>
                                            <button class="btn btn-success pull-right btn-sm mx-1" onclick="document.getElementById('province-'+{{$order->id}}).submit();">รับ</button>
                                            <button class="btn btn-danger pull-right btn-sm" onclick="document.getElementById('cprovince-'+{{$order->id}}).submit();">ยกเลิก</button>
                                        </div>
                                        <form action="{{url('staff/order/addToBranch')}}" method="post" id="{{'province-'.$order->id}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                        </form>
                                        <form action="{{url('staff/order/cancle')}}" method="post" id="{{'cprovince-'.$order->id}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                        </form>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>

                        <div class="card col-md-12 border-success pb-2">
                            <div class="card-header">ต่างจังหวัด</div>
                            <div class="card-body">
                                <div class="list-group">

                                    @foreach ($out_province_orders as $order)
                                        <div class="list-group-item">
                                            <div>ออเดอร์หมายเลข: {{$order->id}} | ที่อยู่: {{$order->address}} | เบอร์โทร: {{$order->user->tel_number}}</div>
                                            <br>
                                            <button class="btn btn-success pull-right btn-sm mx-1" onclick="document.getElementById('nprovince-'+{{$order->id}}).submit();">รับ</button>
                                            <button class="btn btn-danger pull-right btn-sm" onclick="cancleOrder({{$order->id}}, '{{$order->user->tel_number}}')">ยกเลิก</button>
                                        </div>
                                        <form action="{{url('staff/order/addToBranch')}}" method="post" id="{{'nprovince-'.$order->id}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                        </form>
                                        <form action="{{url('staff/order/cancle')}}" method="post" id="{{'cnprovince-'.$order->id}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                        </form>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $allders = [];
    $arr = '[';
    foreach ($first_orders as $key => $value) {
        $allders[] = $value->id;
    }
    foreach ($second_orders as $key => $value) {
        $allders[] = $value->id;
    }
    foreach ($district_orders as $key => $value) {
        $allders[] = $value->id;
    }
    foreach ($province_orders as $key => $value) {
        $allders[] = $value->id;
    }
    foreach ($out_province_orders as $key => $value) {
        $allders[] = $value->id;
    }
    foreach ($allders as $key => $value) {
        if(count($allders) == $key + 1){
            $arr = $arr . $value . ']';
        }else {
            $arr = $arr . $value .',';
        }

    }
@endphp
<input type="hidden" name="allders" id="allders" value="{!!$arr!!}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- Pusher Noti. --}}
<script>

    setInterval(() => {
        location.reload();
    }, 35000);
    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
        cluster: 'ap1',
        forceTLS: true
    });

    let cancleOrder;

    $(function() {
        var allders = JSON.parse($('#allders').val());
        console.log(allders)
        var channel = pusher.subscribe('order');
        channel.bind('my-event', function(data) {
            if (allders.includes(parseInt(data.message))) {
                location.reload();
            }
        });
        cancleOrder = function (id, tel) {
            swal({
                title: "แน่ใจหรือไม่",
                text: "คำสั่งซื้อหมายเลข " + id + " จะถูกยกเลิก กรุณาโทรแจ้งลูกค้าที่เบอร์: " + tel,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('cnprovince-'+id).submit();
                    swal("ยกเลิกคำสั่งซื้อเรียบร้อย", {
                        icon: "success"
                    });
                }
            });
        }
    })
</script>
@endsection
