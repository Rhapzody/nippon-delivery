@extends('back.layout.app')

@section('content')
<h4 class="page-title"><span class="la la-clipboard"></span> จัดการผู้ใช้งาน</h4>
<div class="row">
    <div class="col-md-12 bg-light border border-primary rounded p-2">

        @include('back.widget.nav-user')

        <hr>

        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">เพิ่มผู้ใช้งาน</div>
                    </div>
                    <form class="card-body" action="{{url('/staff/user/add/process')}}" method="POST" enctype="multipart/form-data"
                        id="add-user">

                        <div class="form-group">
                            <label for="first_name"><span class="text-danger">*</span>ชื่อ</label>
                            <input type="text" class="form-control" id="first_name" placeholder="ชื่อ" name="first_name">
                            <span class="text-danger" id="first_name_text"></span>
                        </div>

                        <div class="form-group">
                            <label for="last_name"><span class="text-danger">*</span>นามสกุล</label>
                            <input type="text" class="form-control" id="last_name" placeholder="นามสกุล" name="last_name">
                            <span class="text-danger" id="last_name_text"></span>
                        </div>

                        <div class="form-group">
                            <label for="user_name"><span class="text-danger">*</span>User name (ตัวอักษรอย่างน้อย 6
                                ตัว)</label>
                            <input type="text" class="form-control" id="user_name" placeholder="ชื่อผู้ใช้งาน" name="user_name">
                            <span class="text-danger" id="user_ame_text"></span>
                        </div>

                        <div class="form-group">
                            <label for="email"><span class="text-danger">*</span>email</label>
                            <input type="email" class="form-control" id="email" placeholder="อีเมล" name="email">
                            <span class="text-danger" id="email_text"></span>
                        </div>

                        <div class="form-group">
                            <label for="password"><span class="text-danger">*</span>password (A-Z, a-z, 0-9
                                อย่างน้อยอย่างละ 1 ตัว ความยาว 6 ตัวอักษร)</label>
                            <input type="password" class="form-control" id="password_1" name="password_1" placeholder="รหัสผ่าน">
                            <span class="text-danger" id="password_1_text"></span>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="text-danger">*</span>ยืนยัน password</label>
                            <input type="password" class="form-control" id="password_2" name="password_2" placeholder="รหัสผ่านอีกครั้ง">
                            <span class="text-danger" id="password_2_text"></span>
                        </div>

                        <div class="form-group">
                            <label for="role"><span class="text-danger">*</span>หน้าที่</label>
                            <select name="role" id="role" class="form-control">
                                <option value="-1">เลือกตำแหน่ง</option>
                                @foreach ($roles as $role)
                                    <option value={{$role->id}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="role_text"></span>
                        </div>

                        <div class="form-row mx-1">
                            <div class="form-group col-md-3">
                                <label for="tel_number"><span class="text-danger">*</span>เบอร์โทรศัพท์</label>
                                <input type="text" maxlength="10" minlength="10" name="tel_number" id="tel_number"
                                    class="form-control">
                                <span class="text-danger" id="tel_number_text"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="province"><span class="text-danger">*</span>จังหวัด</label>
                                <select name="province" id="province" class="form-control">
                                    <option value="-1">เลือกจังหวัด</option>
                                    @foreach ($provinces as $province)
                                        <option value={{$province->id}}>{{$province->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="province_text"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="district"><span class="text-danger">*</span>อำเภอ</label>
                                <select name="district" id="district" class="form-control">
                                    <option value="-1">เลือกอำเภอ</option>
                                </select>
                                <span class="text-danger" id="district_text"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="sub_district"><span class="text-danger">*</span>ตำบล</label>
                                <select name="sub_district" id="sub_district" class="form-control">
                                    <option value="-1">เลือกตำบล</option>
                                </select>
                                <span class="text-danger" id="sub_district_text"></span>
                            </div>
                        </div>

                        <div class="form-row mx-1">
                            <div class="form-group col-md-3">
                                <label for="road">ถนน</label>
                                <input type="text" class="form-control" name="road" id="road" placeholder="ถนน">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="alley">ตรอก/ซอย</label>
                                <input type="text" class="form-control" name="alley" id="alley" placeholder="ตรอก/ซอย">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="village_number"><span class="text-danger">*</span>หมู่</label>
                                <input type="text" class="form-control" name="village_number" id="village_number"
                                    placeholder="หมู่ที่">
                                <span class="text-danger" id="village_number_text"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="house_number"><span class="text-danger">*</span>บ้านเลขที่</label>
                                <input type="text" class="form-control" name="house_number" id="house_number"
                                    placeholder="บ้านเลขที่">
                                <span class="text-danger" id="house_number_text"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="additional_address">รายละเอียดที่อยู่เพิ่มเติม</label>
                            <textarea class="form-control" id="additional_address" rows="5" name="additional_address"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_image">รูปประจำตัว </label>
                            <input type="file" name="image" id="user_image" accept="image/png, image/jpeg">
                            <img id="blah" src="{{url('/storage/man.png')}}" alt="your image" width="256px" height="256px" />
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
                            <input class="btn btn-success" type="submit" value=" เพิ่ม " id="my-submit">
                            <a class="btn btn-danger" href="#cl-but" onclick="clearConfirm(this)" style="color:white;"
                                id="cl-but">ล้าง</a>
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
                role: {
                    required: true,
                    pattern: /^[+]?\d+([.]\d+)?$/
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
                role: {
                    required: "เลือกบทบาท",
                    pattern: "เลือกบทบาท"
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
                    pattern: "ใส่หมายเลข 10 หลักให้ถูกต้อง"
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

    });

    function clearConfirm(e) {
        swal({
            title: "แน่ใจหรือไม่",
            text: "ข้อมูลที่กรอกไว้จะถูกลบออกทั้งหมด",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                document.getElementById("add-user").reset();
                swal("เคลียร์ข้อมูลเรียบร้อย", {
                    icon: "success"
                });
            }
        });
    }

</script>

@endsection
