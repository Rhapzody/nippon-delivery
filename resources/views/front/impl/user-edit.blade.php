@extends('front.layout.app')
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
                {{-- content --}}
                <div class="card">
                    <form class="card-body" action="{{url('user/edit/process')}}" method="POST" enctype="multipart/form-data"
                        id="add-user">
                        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                        @if(Session::has('message'))
                        <p class="text-success">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-group">
                            <label for="first_name"><span class="text-danger">*</span>ชื่อ</label>
                            <input value="{{$user->first_name}}" type="text" class="form-control" id="first_name"
                                placeholder="ชื่อ" name="first_name">
                        </div>

                        <div class="form-group">
                            <label for="last_name"><span class="text-danger">*</span>นามสกุล</label>
                            <input value="{{$user->last_name}}" type="text" class="form-control" id="last_name"
                                placeholder="นามสกุล" name="last_name">
                        </div>

                        <div class="rounded p-3 panel panel-primary">
                            <div class="panel-heading">
                                เปลี่ยนรหัสผ่าน
                            </div>
                            <div id="change-password" class="panel-body">
                                <div class="form-group">
                                    <label for="password_old"><span class="text-danger">*</span>password เดิม</label>
                                    <input type="password" class="form-control" id="password_old" placeholder="รหัสผ่านเดิม">
                                </div>
                                <div class="form-group">
                                    <label for="password"><span class="text-danger">*</span>password ใหม่</label>
                                    <input type="password" class="form-control" id="password_1" placeholder="รหัสผ่านใหม่">
                                </div>
                                <div class="form-group">
                                    <label for="password"><span class="text-danger">*</span>ยืนยัน password ใหม่</label>
                                    <input type="password" class="form-control" id="password_2" placeholder="รหัสผ่านใหม่อีกครั้ง">
                                </div>
                                <button value="บันทึก" class="btn btn-primary ml-2" id="change_pass_but">บันทึก</button>
                                <span class="" id="change_password_text"></span>
                            </div>
                        </div>

                        <div class="form-row mx-1">
                            <div class="form-group col-md-3">
                                <label for="tel_number"><span class="text-danger">*</span>เบอร์โทรศัพท์</label>
                                <input value="{{$user->tel_number}}" type="text" maxlength="10" minlength="10" name="tel_number"
                                    id="tel_number" class="form-control">
                                <span class="text-danger" id="tel_number_text"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="province"><span class="text-danger">*</span>จังหวัด</label>
                                <select name="province" id="province" class="form-control">
                                    <option value="-1">เลือกจังหวัด</option>
                                    @foreach ($provinces as $item)
                                    @if ($user->subDistrict->district->province->id == $item->id)
                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="district"><span class="text-danger">*</span>อำเภอ</label>
                                <select name="district" id="district" class="form-control">
                                    <option value="{{$user->subDistrict->district->id}}">{{$user->subDistrict->district->name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="sub_district"><span class="text-danger">*</span>ตำบล</label>
                                <select name="sub_district" id="sub_district" class="form-control">
                                    <option value="{{$user->subDistrict->id}}">{{$user->subDistrict->name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row mx-1">
                            <div class="form-group col-md-3">
                                <label for="road">ถนน</label>
                                <input value="{{$user->road}}" type="text" class="form-control" name="road" id="road"
                                    placeholder="ถนน">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="alley">ตรอก/ซอย</label>
                                <input value="{{$user->alley}}" type="text" class="form-control" name="alley" id="alley"
                                    placeholder="ตรอก/ซอย">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="village_number"><span class="text-danger">*</span>หมู่</label>
                                <input value="{{$user->village_number}}" type="text" class="form-control" name="village_number"
                                    id="village_number" placeholder="หมู่ที่">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="house_number"><span class="text-danger">*</span>บ้านเลขที่</label>
                                <input value="{{$user->house_number}}" type="text" class="form-control" name="house_number"
                                    id="house_number" placeholder="บ้านเลขที่">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="additional_address">รายละเอียดที่อยู่เพิ่มเติม</label>
                            <textarea class="form-control" id="additional_address" rows="5" name="additional_address">{{$user->additional_address}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_image">รูปประจำตัว </label>
                            <input type="file" name="image" id="user_image" accept="image/png, image/jpeg">
                            <img id="blah" src="{{ getUrl($user->picture_name) }}" alt="your image"
                                width="256px" height="256px" />
                        </div>

                        @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        @csrf
                        <div class="card-action">
                            <input class="primary-btn order-submit" type="submit" value=" บันทึก " id="my-submit">
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

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

        //show image
        $("#user_image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });

        function imageIsLoaded(e) {
            $('#blah').attr('src', e.target.result);
        };

        //validate

        $('#add-user').validate({ // initialize the plugin

            rules: {
                first_name: {
                    required: true,
                    maxlength: 255
                },
                last_name: {
                    required: true,
                    maxlength: 255
                },
                user_name: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                },
                email: {
                    required: true,
                    maxlength: 255,
                    email: true
                },
                password_1: {
                    required: true,
                    minlength: 6,
                    maxlength: 255,
                    pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/
                },
                password_2: {
                    required: true,
                    minlength: 6,
                    maxlength: 255,
                    pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/,
                    equalTo: '#password_1'
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
                tel_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    pattern: /^\d{10}$/
                },
                image: {
                    extension: "png|jpeg|jpg"
                }

            },
            messages: {
                first_name: {
                    required: "อย่าลืมใส่ชื่อจริง",
                    maxlength: "มากสุด 255 ตัวอักษร"
                },
                last_name: {
                    required: "อย่าลืมใส่นามสกุล",
                    maxlength: "มากสุด 255 ตัวอักษร"
                },
                user_name: {
                    required: "อย่าลืมใส่ชื่อผู้ใช้",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    minlength: "น้อยสุด 6 ตัวอักษร",
                },
                email: {
                    required: "อย่าลืมใส่อีเมลแอดเดรส",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    email: "ใส่อีเมลให้ถูกต้อง"
                },
                password_1: {
                    required: "อย่าลืมกำหนดรหัสผ่าน",
                    minlength: "น้อยสุด 6 ตัวอักษร",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    pattern: "ต้องมี A-Z อย่างน้อย 1 ตัว a-z อย่างน้อย 1 ตัว และตัวเลขอย่างน้อย 1 ตัว"
                },
                password_2: {
                    required: "อย่าลืมกำหนดรหัสผ่าน",
                    minlength: "น้อยสุด 6 ตัวอักษร",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    pattern: "ต้องมี A-Z อย่างน้อย 1 ตัว a-z อย่างน้อย 1 ตัว และตัวเลขอย่างน้อย 1 ตัว",
                    equalTo: "ยืนยันรหัสผ่าน ไม่ตรงกัน"
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
                tel_number: {
                    required: "อย่าลืมใส่หมายเลขโทรศัทพ์มือถือ",
                    minlength: "น้อยสุด 10 ตัวอักษร",
                    maxlength: "มากสุด 10 ตัวอักษร",
                    pattern: "ใส่หมายเลขให้ถูกต้อง"
                },
                image: {
                    extension: "รองรับไฟล์ png jpeg jpg เท่านั้น"
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

        $('#change_pass_but').click(function (e) {
            e.preventDefault();
            swal({
                title: "แน่ใจหรือไม่",
                text: "รหัสผ่านของท่านจะถูกเปลี่ยน",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    let oldPass = $('#password_old').val();
                    let firstPass = $('#password_1').val();
                    let secondPass = $('#password_2').val();
                    let userId = $('#user_id').val();
                    $.post("{{url('/staff/user/edit/changePassword')}}",{
                        user_id:userId,
                        password_old:oldPass,
                        password_1:firstPass,
                        password_2:secondPass,
                        _token:"{{csrf_token()}}"
                    },function (data) {
                        if(data.status === "success"){
                            $('#change_password_text')
                                .html("เปลี่ยนรหัสผ่านเรียบร้อย")
                                .attr('class','text-success');
                        }else{
                            $('#change_password_text')
                                .html("ไม่สามารถเปลี่ยนรหัสผ่านได้ อาจเนื่องจาก รหัสผ่านเดิมไม่ถูกต้อง หรือรหัสผ่านไม่ตรงกัน หรือรหัสผ่านไม่ตรงตามข้อกำหนด")
                                .attr('class','text-danger');
                            $('#password_old').addClass("is-invalid");
                            $('#password_1').addClass("is-invalid");
                            $('#password_2').addClass("is-invalid");
                        }
                    });
                }
            });

        });
    });


</script>

@endsection
