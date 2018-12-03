@extends('back.layout.app')

@section('content')

<h4 class="page-title"><span class="la la-clipboard"></span> ประวัติการสั่งซื้อ</h4>
<div class="row">
    <div class="col-md-12 bg-light border rounded p-2">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-2">
                            @hasrole('เจ้าของร้าน')
                                <div class="col">
                                    <span>สาขา: </span>
                                    <select name="branch" id="branch" class="form-control">
                                        <option value="-1">ทั้งหมด</option>
                                        @foreach ($branches as $item)
                                            <option value="{{$item->id}}" {{($item->id == $branch_id)?"selected":""}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endhasrole
                            @hasrole('ผู้จัดการสาขา')
                                <div class="col">
                                    <span>สาขา: </span>
                                    <select name="branch" id="branch" class="form-control">
                                        <option value="-1">ทั้งหมด</option>
                                        <option value="{{Auth::user()->subDistrict->branch_id}}" {{(Auth::user()->subDistrict->branch_id == $branch_id)?"selected":""}}>
                                            {{Auth::user()->subDistrict->branch->name}}
                                        </option>
                                    </select>
                                </div>
                            @endhasrole
                            <div class="col">
                                <span>สถานะ: </span>
                                <select name="status" id="status" class="form-control">
                                    <option value="-1">ทั้งหมด</option>
                                    @foreach ($status as $item)
                                        <option value="{{$item->code}}" {{($item->code == $code)?"selected":""}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <span>วันที่: </span>
                                <input type="date" name="from" id="from" class="form-control" value="{{$from}}">
                            </div>
                            <div class="col">
                                <span>ถึง</span>
                                <input type="date" name="to" id="to" class="form-control" value="{{$to}}">
                            </div>
                            <form action="{{url('staff/history/find')}}" method="get" class="col">
                                    <div class="row">
                                        <div class="col">
                                            <span>หมายเลขสั่งซื้อที่: </span>
                                            <input type="text" name="order_id" id="" class="form-control" value="{{$order_id}}">
                                        </div>
                                        <div>
                                            <input type="submit" value="ค้นหา" style="display: none;">
                                        </div>
                                    </div>
                            </form>
                        </div>


                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">คำสั่งซื้อที่</th>
                                    <th class="text-center">วันที่สั่งซื้อ</th>
                                    <th class="text-center">สถานะการสั่งซื้อ</th>
                                    <th class="text-center">ดูรายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center">{{$order->id}}</td>
                                        <td style="vertical-align: middle;" class="text-center">{{$order->created_at}}</td>
                                        <td style="vertical-align: middle;" class="text-center">{{$order->orderStatus->name}}</td>
                                        <td align="center">
                                            <button onclick="viewOrder({{$order->id}})" style="vertical-align: middle;" title="ดูรายละเอียด" type="button" class="btn btn-primary btn-sm center">
                                                <span class="la la-search-plus" style="font-size:150%"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        {{ $orders->links() }}

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
    //user/history/order/{id}
    let viewOrder;
    $(function() {

        $('#branch').change(search);
        $('#status').change(search);
        $('#from').change(search);
        $('#to').change(search);

        function search(){
            let branch = $('#branch').val();
            let status = $('#status').val();
            let from = $('#from').val();
            let to = $('#to').val();
            console.log(`Branch: ${branch}, Status: ${status}, From: ${from}, To: ${to}`);
            window.location.href = `{{url('staff/history/${branch}/${status}/${from}/${to}')}}`;
        }

        viewOrder = function(orderId) {
            window.location.href = `{{url('staff/history/order')}}` + "/" + orderId;
        }
    });
</script>
@endsection
