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
                <span>สถานะ : </span>
                <select name="status_search" id="status_search">
                        <option value="">ทั้งหมด</option>
                    @foreach ($status as $item)
                        <option value="{{$item->code}}" {{($item->code == $code)?"selected":""}}>{{$item->name}}</option>
                    @endforeach
                </select>
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
                                    <button onclick="viewOrder({{$order->id}})" style="vertical-align: middle;" title="ดูรายละเอียด" type="button" class="primary-btn order-submit btn-sm center">
                                        <span class="fa fa-search-plus" style="font-size:150%"></span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}

                <script>
                    var page = document.getElementsByClassName('pagination')[0];
                    if (page) {
                        page.classList.remove('pagination');
                        page.classList.add('store-pagination');
                    }
                </script>

            </div>

        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    //user/history/order/{id}
    let viewOrder;
    $(function() {
        $('#status_search').change(function() {
            let code = $('#status_search').val();
            window.location.href = `{{url('user/history')}}` + "/" + code;
        })

        viewOrder = function(orderId) {
            window.location.href = `{{url('user/history/order')}}` + "/" + orderId;
        }
    });
</script>

@endsection
