@extends('back.layout.app')

@section('content')

<h4 class="page-title"><span class="la la-clipboard"></span> ยอดขาย</h4>
<div class="row">
    <div class="col-md-12 bg-light border rounded p-2">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-header row">
                        <span class="card-title col-md-1">สาขา: </span>
                        @hasrole('ผู้จัดการสาขา')
                            <select name="branch" id="branch" class="form-control col-md-4">
                                <option value="{{Auth::user()->subDistrict->branch_id}}">{{Auth::user()->subDistrict->branch->name}}</option>
                            </select>
                        @endhasrole
                        @hasrole('เจ้าของร้าน')
                            <select name="branch" id="branch" class="form-control col-md-4">
                                <option value="-1">ทั้งหมด</option>
                                @foreach ($branches as $item)
                                    <option value="{{$item->id}}" {{($item->id == $branch_id)?"selected":""}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        @endhasrole
                    </div>
                    <div class="card-body">
                        <div class="row">
                                <div class="card bg-light mb-3 mx-2 col">
                                    <div class="card-header">วันที่</div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="today"></h5>
                                    </div>
                                </div>
                                <div class="card bg-light mb-3 mx-2 col">
                                    <div class="card-header">จำนวนออเดอร์</div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="number_order"></h5>
                                    </div>
                                </div>
                                <div class="card bg-light mb-3 mx-2 col">
                                    <div class="card-header">ยอดขาย</div>
                                    <div class="card-body">
                                        <h5 class="card-title"><span id="sum_income"></span> บาท</h5>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="card bg-light mb-3 mx-2 col">
                                <div class="card-header row">
                                    <span>ยอดขาย</span>
                                    <div class="col">
                                        <span>วันที่: </span>
                                        <input type="date" name="from" id="from" class="form-control" value="{{$from}}">
                                    </div>
                                    <div class="col">
                                        <span>ถึง</span>
                                        <input type="date" name="to" id="to" class="form-control" value="{{$to}}">
                                    </div>
                                </div>
                                <div class="card-body" id="chart-box">
                                    <canvas id="myChart" width="100%" height="45px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card bg-light mb-3 mx-2 col">
                                <div class="card-header ">
                                    <span>Top 20 เมนูยอดฮิต</span>
                                </div>
                                <div class="card-body" id="chart-box">

                                        <table class="table table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th>อันดับ</th>
                                                    <th class="text-center">รูป</th>
                                                    <th class="text-center">ชื่อ</th>
                                                    <th class="text-center">ราคาต่อชิ้น(บาท)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($top_menu as $key=>$menu)
                                                    <tr>
                                                        <td>#{{$key+1}}</td>
                                                        <td style="vertical-align: middle;" class="text-center"><img src="{{url('/storage',[$menu->menuPictures[0]->name])}}" alt="" width="50px" height="50px"></td>
                                                        <td style="vertical-align: middle;" class="text-center"><a href="{{url('product',[$menu->id])}}">{{$menu->name}}</a></td>
                                                        <td style="vertical-align: middle;" class="text-center">{{$menu->price}} บาท</td>

                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<script>
    $(function() {

        dateChange = function() {
            $("#chart-box").html('<canvas id="myChart" width="100%" height="45px"></canvas>');
            let ctx = $("#myChart");
            //console.log('date cheanged')
            $.ajax({
                url: "{{url('staff/sales/data')}}",
                type: "get",
                data: {
                    branch_id: $('#branch').val(),
                    from: $('#from').val(),
                    to: $('#to').val()
                },
                success: function(response) {
                    //console.log('success')
                    let my_label = [];
                    let my_data = [];
                    //console.log(response)
                    let first_date = (new Date(response[0]['created_at']).toDateString());
                    let sum = 0;
                    response.forEach((ele ,index) => {
                        //console.log(ele)
                        if(first_date != (new Date(ele.created_at).toDateString())){
                            my_label.push(first_date);
                            my_data.push(sum);
                            sum = 0;
                            first_date = (new Date(ele.created_at).toDateString());
                        }

                        ele.order_menus.forEach(list => {
                            sum += list.quantity * list.menu.price;
                        });

                        if(index == response.length - 1){
                            my_label.push(first_date);
                            my_data.push(sum);
                        }


                    });

                    let myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: my_label,
                            datasets: [{
                                data: my_data,
                                label: "ยอดขาย (บาท)",
                                borderColor: "#3e95cd",
                                fill: false
                            }]
                        },
                        options: {
                            title: {
                            display: true
                            }
                        }
                    });
                },
                error: function(xhr) {
                    //Do Something to handle error
                }
            });
        }

        $('#from').change(dateChange);
        $('#to').change(dateChange);

        function branchChange() {
            $.get("{{url('staff/sales/todayStat')}}" + "/?branch_id=" + $('#branch').val(), function(data) {
                if (data.length == 0) {
                    $('#today').html((new Date()).toDateString());
                    $('#number_order').html(0);
                    $('#sum_income').html(0);
                }else{
                    let sum_income = 0;
                    let sum_order = data.length;
                    let date = (new Date(data[0]['created_at']).toDateString());
                    data.forEach(ele => {
                        ele.order_menus.forEach(list => {
                            sum_income += list.quantity * list.menu.price;
                        });
                    });
                    $('#today').html(date);
                    $('#number_order').html(sum_order);
                    $('#sum_income').html(sum_income);
                }
            })
        }
        $('#branch').change(function() {
            branchChange();
            dateChange();
        });

        branchChange();
        dateChange();

    });
</script>
@endsection
