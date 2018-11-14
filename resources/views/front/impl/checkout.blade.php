@extends('front.layout.app')

@section('content')

<!-- BREADCRUMB -->
@include('front.widget.breadcrumb',[
    'header'=>$header
])

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            {{-- checkout detail --}}
            <div class="col-md-8 order-details">
                <div class="section-title text-center">
                    <h3 class="title">เมนูที่สั่ง</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>เมนู</strong></div>
                        <div><strong>รวม (บาท)</strong></div>
                    </div>
                    <div class="order-products">
                        @foreach ($menus as $menu)
                            <div class="order-col">
                                <div>{{$menu->quantity}}x {{$menu->menu->name}}</div>
                                <div>{{$menu->quantity * $menu->menu->price}}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="order-col">
                        <div>ค่าจัดส่ง</div>
                        <div><strong>{{$ship_cost}}</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>รวมทั้งสิ้น</strong></div>
                        <div><strong class="order-total">{{$ship_cost + $sum_price}}</strong></div>
                    </div>
                </div>
                <form action="{{url('user/checkout/process')}}" method="post" id="checkout-from">
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="address_option" id="address_option_1" checked value="origin">
                            <label for="address_option_1">
                                <span></span>
                                ที่อยู่เดิม
                            </label>
                            <div class="caption">
                                <p>{{$user_address}}</p>
                                <input type="hidden" name="origin_address" value="{{$user_address}}" id="origin_address">
                                <input type="hidden" name="sub_district_id" value="{{$sub_district->id}}">
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="address_option" id="address_option_2" value="other">
                            <label for="address_option_2">
                                <span></span>
                                ที่อยู่อื่น
                            </label>
                            <div class="caption" id="other_address_form">

                                <label for="province"><span class="text-danger">*</span>จังหวัด</label>
                                <select name="province" id="province" class="form-control">
                                    <option value="-1">เลือกจังหวัด</option>
                                    @foreach ($provinces as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <div></div>

                                <label for="district"><span class="text-danger">*</span>อำเภอ</label>
                                <select name="district" id="district" class="form-control">
                                    <option value=""></option>
                                </select>
                                <div></div>

                                <label for="sub_district"><span class="text-danger">*</span>ตำบล</label>
                                <select name="sub_district" id="sub_district" class="form-control">
                                    <option value=""></option>
                                </select>
                                <div></div>

                                <label for="road">ถนน</label>
                                <input value="" type="text" class="form-control" name="road" id="road"
                                    placeholder="ถนน">
                                <div></div>

                                <label for="alley">ตรอก/ซอย</label>
                                <input value="" type="text" class="form-control" name="alley" id="alley"
                                    placeholder="ตรอก/ซอย">
                                <div></div>

                                <label for="village_number"><span class="text-danger">*</span>หมู่</label>
                                <input value="" type="text" class="form-control" name="village_number"
                                    id="village_number" placeholder="หมู่ที่">
                                <div></div>

                                <label for="house_number"><span class="text-danger">*</span>บ้านเลขที่</label>
                                <input value="" type="text" class="form-control" name="house_number"
                                    id="house_number" placeholder="บ้านเลขที่">
                                <div></div>

                                <label for="additional_address">รายละเอียดที่อยู่เพิ่มเติม</label>
                                <textarea class="form-control" id="additional_address" rows="5" name="additional_address"></textarea>
                                <div></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    @csrf
                    <button type="submit" class="primary-btn order-submit col-md-4">สั่งเลย</button>
                    <div class="col-md-4"></div>
                </form>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
        $(document).ready(function () {

            //validate instance
            let valid;

            //radio button for select address
            let radioAddr = $('input[name="address_option"]');
            radioAddr.change(function () {
                let checked = radioAddr.filter(function () {
                    return $(this).prop('checked');
                });
                if (checked.val() === 'origin') {
                    valid.destroy();
                } else {
                    //validate
                    valid = $('#checkout-from').validate({ // initialize the plugin
                        rules: {
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
                            }
                        },
                        messages: {
                            province: {
                                required: "กรุณาเลือกจังหวัด",
                                pattern: "เลือกจังหวัด",
                            },
                            district: {
                                required: "กรุณาเลือกอำเภอ/เขต",
                                pattern: "เลือกอำเภอ/เขต"
                            },
                            sub_district: {
                                required: "กรุณาเลือกตำบล",
                                pattern: "เลือกตำบล"
                            },
                            village_number: {
                                required: "กรุณาใส่หมู่ที่",
                                maxlength: "หมู่ที่ ไม่ถูกต้อง"
                            },
                            house_number: {
                                required: "กรุณาใส่บ้านเลขที่",
                                maxlength: "บ้านเลขที่ไม่ถูกต้อง *ขนาดยาวเกินไป"
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
                }
            });

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



        //end jq
        });
</script>

@endsection
