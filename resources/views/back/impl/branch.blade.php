@extends('back.layout.app')

@section('content')
<style>
    /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
    #map {
        height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #map {
        height: 500px;
        width: 100%;
    }
    #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        margin-top: 10px;
        width: 500px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 345px;
    }
</style>
<h4 class="page-title"><span class="la la-clipboard"></span> จัดการข้อมูลสาขา</h4>
<div class="row">
    <div class="col-md-12 bg-light border border-primary rounded p-2">

        <hr>

        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">สาขา</div>
                    </div>
                    <div class="card-body">
                        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                        <div id="map"></div>
                        <script>
                            let tempMap;
                            function initMap() {
                                var mapOptions = {
                                    center: {
                                        lat: 13.847860,
                                        lng: 100.604274
                                    },
                                    zoom: 6,
                                    disableDoubleClickZoom: true
                                }

                                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                                tempMap = map;

                                //for searching
                                // Create the search box and link it to the UI element.
                                var input = document.getElementById('pac-input');
                                var searchBox = new google.maps.places.SearchBox(input);
                                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                                // Bias the SearchBox results towards current map's viewport.
                                map.addListener('bounds_changed', function () {
                                    searchBox.setBounds(map.getBounds());
                                });

                                var markers = [];
                                // Listen for the event fired when the user selects a prediction and retrieve
                                // more details for that place.
                                searchBox.addListener('places_changed', function () {
                                    var places = searchBox.getPlaces();

                                    if (places.length == 0) {
                                        return;
                                    }

                                    // Clear out the old markers.
                                    markers.forEach(function (marker) {
                                        marker.setMap(null);
                                    });
                                    markers = [];

                                    // For each place, get the icon, name and location.
                                    var bounds = new google.maps.LatLngBounds();
                                    places.forEach(function (place) {
                                        if (!place.geometry) {
                                            console.log("Returned place contains no geometry");
                                            return;
                                        }
                                        var icon = {
                                            url: place.icon,
                                            size: new google.maps.Size(71, 71),
                                            origin: new google.maps.Point(0, 0),
                                            anchor: new google.maps.Point(17, 34),
                                            scaledSize: new google.maps.Size(25, 25)
                                        };

                                        // Create a marker for each place.
                                        markers.push(new google.maps.Marker({
                                            map: map,
                                            icon: icon,
                                            title: place.name,
                                            position: place.geometry.location
                                        }));

                                        if (place.geometry.viewport) {
                                            // Only geocodes have viewport.
                                            bounds.union(place.geometry.viewport);
                                        } else {
                                            bounds.extend(place.geometry.location);
                                        }
                                    });
                                    map.fitBounds(bounds);
                                });

                            }

                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUqxyKsLRJ8ByM6LiCdfGMi-smKmmJlSI&libraries=places&callback=initMap"
                            async defer></script>

                    </div>
                </div>

                <div class="card">
                    {{-- สาขาทั้งหมด --}}
                    <div class="card-header">
                        <div class="card-title">สาขาทั้งหมด</div>
                    </div>
                    <div class="card-body">
                        <form action="{{url('staff/branch')}}" method="GET" class="row mx-4 mb-2">
                            <select name="find_mode" id="" class="form-control col-md-1 mr-1">
                                <option value="-1">---</option>
                                <option value="1" {{($find_mode == 1)?"selected":""}}>ID</option>
                                <option value="2" {{($find_mode == 2)?"selected":""}}>ชื่อ</option>
                            </select>
                            <input type="text" name="search" id="" class="form-control col-md-4 mr-1" value="{{$search}}">
                            <button class="btn btn-primary" type="submit"><i class="la la-search"></i> ค้นหา</button>
                        </form>
                        <table class="table table-bordred">
                            <thead>
                                <tr>
                                    <th>รหัสสาขา</th>
                                    <th>สาขา</th>
                                    <th>ประจำตำบล</th>
                                    <th>พิกัด (lat, long)</th>
                                    <th>สถานะ</th>
                                    <th>เปิด/ปิด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{$branch->id}}</td>
                                        <td>{{$branch->name}}</td>
                                        <td>{{($branch->subDistrict == null)?"**ปิดถาวร**":$branch->subDistrict->name}}</td>
                                        <td>{{$branch->lat . ", " . $branch->long}}</td>
                                        <td>{{($branch->status == 1)?"เปิด":"ปิด"}}</td>
                                        <td>
                                            @if ($branch->status == 1)
                                                <form action="{{url('staff/branch/close')}}" method="POST" id="{{'switch' . $branch->id}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$branch->id}}">
                                                    <button class="btn btn-danger" type="button" onclick="switchBranch('{{'switch' . $branch->id}}', '{{$branch->name}}')" {{($branch->subDistrict == null)?"disabled":""}}>ปิด</button>
                                                </form>
                                            @else
                                                <form action="{{url('staff/branch/open')}}" method="POST" id="{{'switch' . $branch->id}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$branch->id}}">
                                                    <button class="btn btn-success" type="button" onclick="switchBranch('{{'switch' . $branch->id}}', '{{$branch->name}}')" {{($branch->subDistrict == null)?"disabled":""}}>เปิด</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($is_search == false)
                            {{$branches->links()}}
                        @endif
                    </div>
                </div>

                <div class="card">
                    {{-- เพิ่มสาขา --}}
                    <div class="card-header">
                        <div class="card-title">เพิ่มสาขาใหม่</div>
                    </div>
                    <div class="card-body">
                            <form action="{{url('staff/branch/create')}}" method="post" id="create_branch">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><span class="text-danger">*</span>ชื่อสาขา</label>
                                    <input type="branch_name" class="form-control" id="branch_name" aria-describedby="emailHelp" name="branch_name">
                                </div>
                                <div class="form-row mx-1">
                                    <div class="form-group col-md-4">
                                        <label for="province"><span class="text-danger">*</span>จังหวัด</label>
                                        <select name="province" id="province" class="form-control">
                                            <option value="-1">เลือกจังหวัด</option>
                                            @foreach ($provinces as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="district"><span class="text-danger">*</span>อำเภอ</label>
                                        <select name="district" id="district" class="form-control">
                                                <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sub_district"><span class="text-danger">*</span>ตำบล</label>
                                        <select name="sub_district" id="sub_district" class="form-control">
                                                <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mx-1">
                                    <div class="form-group col-md-3">
                                        <label for="road">ถนน</label>
                                        <input value="" type="text" class="form-control" name="road" id="road" placeholder="ถนน">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="alley">ตรอก/ซอย</label>
                                        <input value="" type="text" class="form-control" name="alley" id="alley" placeholder="ตรอก/ซอย">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="village_number"><span class="text-danger">*</span>หมู่</label>
                                        <input value="" type="text" class="form-control" name="village_number" id="village_number" placeholder="หมู่ที่">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="house_number"><span class="text-danger">*</span>บ้านเลขที่</label>
                                        <input value="" type="text" class="form-control" name="house_number" id="house_number" placeholder="บ้านเลขที่">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="additional_address">รายละเอียดที่อยู่เพิ่มเติม</label>
                                    <textarea class="form-control" id="additional_address" rows="5" name="additional_address"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="latclicked"><span class="text-danger">*</span>ละติจูด</label>
                                    <input type="text" class="form-control" id="latclicked" name="lat" >
                                </div>
                                <div class="form-group">
                                    <label for="longclicked"><span class="text-danger">*</span>ลองติจูด</label>
                                    <input type="text" class="form-control" id="longclicked" name="long" >
                                </div>
                                <label for="">***สามารถดับเบิลคลิกที่แผนที่ด้านบนเพื่อระบุตำแหน่งทางภูมิศาสตร์ของสาขาได้</label>
                                <div class="form-group">
                                    <label for="branch_status"><span class="text-danger">*</span>สถานะ</label>
                                    <select name="status" id="branch_status">
                                        <option value="0">ปิดไว้ก่อน</option>
                                        <option value="1">เปิดทันที</option>
                                    </select>
                                </div>
                                @csrf
                                <button type="button" onclick="createBranch();" class="btn btn-primary">เพิ่ม</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
        let switchBranch;
        let createBranch;
        $(function() {
            //get districts when province selected
            $('#province').change(function () {
                $('#sub_district').empty().append(`<option value="-1">เลือกตำบล</option>`);
                let provinceId = $(this).val();
                if (provinceId >= 0) {
                    let url = "{{url('/district_by_province_id')}}";
                    $.get(url + "?province_id=" + provinceId, function (data, status) {
                        let district = $('#district');
                        district.empty();
                        district.append(`<option value="-1">เลือกอำเภอ</option>`);
                        for (let index = 0; index < data.length; index++) {
                            district.append(
                                `<option value="${data[index].id}">${data[index].name}</option>`
                            );
                        }
                    });
                }
            });

            //get sub districts when district selected
            $('#district').change(function () {
                let districtId = $(this).val();
                if (districtId >= 0) {
                    let url = "{{url('/sub_district_by_district_id')}}";
                    $.get(url + "?district_id=" + districtId, function (data, status) {
                        let subDistrict = $('#sub_district');
                        subDistrict.empty();
                        subDistrict.append(`<option value="-1">เลือกตำบล</option>`);
                        for (let index = 0; index < data.length; index++) {
                            subDistrict.append(
                                `<option value="${data[index].id}">${data[index].name}</option>`
                            );
                        }
                    });
                }
            });

            // Update lat/long value of div when anywhere in the map is clicked
            google.maps.event.addListener(tempMap,'dblclick',function(event) {
                $('#latclicked').val(event.latLng.lat());
                $('#longclicked').val(event.latLng.lng());
            });

            $.get("{{url('staff/branch/all')}}", function(data) {
                data.forEach(ele => {
                    let tempMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(ele.lat, ele.long),
                        map: tempMap,
                        title: 'สาขา: ' + ele.name
                    });

                    // Update lat/long value of div when the marker is clicked
                    tempMarker.addListener('dblclick', function(event) {
                        $('#latclicked').val(event.latLng.lat());
                        $('#longclicked').val(event.latLng.lng());
                    });
                });
            });

            //validate

            $('#create_branch').validate({ // initialize the plugin

                rules: {
                    branch_name: {
                        required: true,
                        maxlength: 255
                    },
                    province: {
                        required: true,
                        pattern: /^[+]?\d+([.]\d+)?$/
                    },
                    district: {
                        required: true,
                        pattern: /^[+]?\d+([.]\d+)?$/
                    },
                    sub_district: {
                        required: true,
                        pattern: /^[+]?\d+([.]\d+)?$/
                    },
                    village_number: {
                        required: true,
                        maxlength: 3
                    },
                    house_number: {
                        required: true,
                        maxlength: 10
                    },
                    lat: {
                        required: true,
                        number: true
                    },
                    long: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    branch_name: {
                        required: "กรุณาระบุชื่อสาขา",
                        maxlength: "ชื่อสาขาความยาวสูงสุด 255 ตัวอักษร"
                    },
                    province: {
                        required: "เลือกจังหวัด",
                        pattern: "เลือกจังหวัด",
                    },
                    district: {
                        required: "เลือกอำเภอ/เขต",
                        pattern: "เลือกอำเภอ/เขต"
                    },
                    sub_district: {
                        required: "เลือกตำบล",
                        pattern: "เลือกตำบล"
                    },
                    village_number: {
                        required: "อย่าลืมใส่หมู่ที่",
                        maxlength: "หมู่ที่ ไม่ถูกต้อง"
                    },
                    house_number: {
                        required: "อย่าลืมใส่บ้านเลขที่",
                        maxlength: "บ้านเลขที่ไม่ถูกต้อง *ขนาดยาวเกินไป"
                    },
                    lat: {
                        required: "กรุณาระบุละติจูด"
                    },
                    long: {
                        required: "กรุณาระบุลองติจูด"
                    }
                },
                errorClass: "is-invalid error",
                validClass: "is-valid valid",
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass(validClass);
                }
            });

            //confirm promt
            switchBranch = function(elemId, name) {
                swal({
                    title: "แน่ใจหรือไม่",
                    text: "ต้องการจะเปลี่ยนสถานะของ สาขา "+name+" หรือไม่ กรุณาตรวจสอบให้รอบคอบ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#' + elemId).submit();
                    }
                });
            }

            createBranch = function() {
                swal({
                    title: "แน่ใจหรือไม่",
                    text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง และให้แน่ใจว่าสาขาใหม่ จะไม่ทับสาขาเก่าในตำบลเดิม หากทับ สาขาเก่าจะถูกปิดตัว",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#create_branch').submit();
                    }
                });
            }
        });
    </script>
@endsection
