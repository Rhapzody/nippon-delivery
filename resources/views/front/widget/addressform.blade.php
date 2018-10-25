<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form class="card-body" action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                id="add-user">

                <div class="col-md-9">

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

                    <div class="form-row mx-1">
                        <div class="form-group col-md-3">
                            <label for="tel_number"><span class="text-danger">*</span>เบอร์โทรศัพท์</label>
                            <input type="text" maxlength="10" minlength="10" name="tel_number" id="tel_number" class="form-control">
                            <span class="text-danger" id="tel_number_text"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="province"><span class="text-danger">*</span>จังหวัด</label>
                            <select name="province" id="province" class="form-control">
                                <option value="-1">เลือกจังหวัด</option>
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
                            <input type="text" class="form-control" name="house_number" id="house_number" placeholder="บ้านเลขที่">
                            <span class="text-danger" id="house_number_text"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="additional_address">รายละเอียดที่อยู่เพิ่มเติม</label>
                        <textarea class="form-control" id="additional_address" rows="5" name="additional_address"></textarea>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="form-group">
                        <label for="user_image">รูปประจำตัว </label>
                        <input type="file" name="image" id="user_image" accept="image/png, image/jpeg">
                        <img id="blah" src="{{url('/storage/man.png')}}" alt="your image" width="256px" height="256px" style="position:relative;left:15%"/>
                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="terms" name="terms">
                        <label for="terms">
                            <span></span>
                            คุณได้อ่าน และยอมรับเงื่อนไขข้อตกลง
                            <br>
                            <a href="#">terms &amp; conditions</a>
                        </label>
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
                        <input class="primary-btn order-submit" type="submit" value="สมัครสมาชิก" id="my-submit" style="width:100%;">
                    </div>
                </div>
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script>
    $(function () {
        //get all province to select box
        let province = $('#province');
        $.get("{{url('provinces')}}", function (data) {
            data.forEach(ele => {
                province.append(`<option value="${ele.id}">${ele.name}</option>`);
            });
        })

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
                terms: {
                    required: true
                },
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
                terms :{
                    required: 'กรุณาอ่าน และยอมรับเงื่อนไขข้อตกลงก่อน'
                },
                first_name: {
                    required: "กรุณาใส่ชื่อจริง",
                    maxlength: "มากสุด 255 ตัวอักษร"
                },
                last_name: {
                    required: "กรุณาใส่นามสกุล",
                    maxlength: "มากสุด 255 ตัวอักษร"
                },
                user_name: {
                    required: "กรุณาใส่ชื่อผู้ใช้",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    minlength: "น้อยสุด 6 ตัวอักษร",
                },
                email: {
                    required: "กรุณาใส่อีเมลแอดเดรส",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    email: "ใส่อีเมลให้ถูกต้อง"
                },
                password_1: {
                    required: "กรุณากำหนดรหัสผ่าน",
                    minlength: "น้อยสุด 6 ตัวอักษร",
                    maxlength: "มากสุด 255 ตัวอักษร",
                    pattern: "ต้องมี A-Z อย่างน้อย 1 ตัว a-z อย่างน้อย 1 ตัว และตัวเลขอย่างน้อย 1 ตัว"
                },
                password_2: {
                    required: "กรุณายืนยันรหัสผ่าน",
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
                    required: "กรุณาระบุหมายเลขโทรศัทพ์",
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
</script>
