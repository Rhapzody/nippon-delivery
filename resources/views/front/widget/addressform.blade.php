<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form class="card-body" action="{{url('/staff/user/add/process')}}" method="POST" enctype="multipart/form-data"
                id="add-user">

                <div class="col-md-8">

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
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="user_image">รูปประจำตัว </label>
                        <input type="file" name="image" id="user_image" accept="image/png, image/jpeg">
                        <img id="blah" src="{{url('/storage/man.png')}}" alt="your image" width="256px" height="256px" style="position:relative;left:15%"/>
                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms &amp; conditions</a>
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
