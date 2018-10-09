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
                            <div class="card-title">แก้ไขผู้ใช้งาน รหัส: 1</div>
                        </div>
                        <form class="card-body" action="" method="POST" >

                            <div class="form-group">
                                <label for="first_name">ชื่อ</label>
                                <input type="text" class="form-control" id="first_name" placeholder="ชื่อ" name="first_name">
                            </div>

                            <div class="form-group">
                                <label for="last_name">นามสกุล</label>
                                <input type="text" class="form-control" id="last_name" placeholder="นามสกุล" name="last_name">
                            </div>

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" placeholder="อีเมล" name="email">
                            </div>

                            <div class="border border-primary rounded p-3">
                            <form action="" method="POST">
                                <h6>เปลี่ยนรหัสผ่าน</h6>
                                <div class="form-group">
                                    <label for="password_old">password เดิม</label>
                                    <input type="password" class="form-control" id="password_old" name="password_old" placeholder="รหัสผ่านเดิม">
                                </div>
                                <div class="form-group">
                                    <label for="password">password ใหม่</label>
                                    <input type="password" class="form-control" id="password_1" name="password_new" placeholder="รหัสผ่านใหม่">
                                </div>
                                <div class="form-group">
                                    <label for="password">ยืนยัน password ใหม่</label>
                                    <input type="password" class="form-control" id="password_2" placeholder="รหัสผ่านใหม่อีกครั้ง">
                                </div>
                                <input type="submit" value="บันทึก" class="btn btn-success ml-2">
                            </form>
                            </div>

                            <div class="form-group">
                                <label for="role">หน้าที่</label>
                                <select name="role" id="role" class="custom-select">
                                    <option value="-1">เลือกตำแหน่ง</option>
                                    <option value="0">เจ้าของร้าน</option>
                                </select>
                            </div>

                            <div class="form-row mx-1">
                                <div class="form-group col-md-4">
                                    <label for="province">จังหวัด</label>
                                    <select name="province" id="province" class="form-control">
                                        <option value="-1">เลือกจังหวัด</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district">อำเภอ</label>
                                    <select name="district" id="district" class="form-control">
                                        <option value="-1">เลือกอำเภอ</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sub_district">ตำบล</label>
                                    <select name="sub_district" id="sub_district" class="form-control">
                                        <option value="-1">เลือกตำบล</option>
                                    </select>
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
                                    <label for="village_number">หมู่</label>
                                    <input type="text" class="form-control" name="village_number" id="village_number" placeholder="หมู่ที่">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="house_number">บ้านเลขที่</label>
                                    <input type="text" class="form-control" name="house_number" id="house_number" placeholder="บ้านเลขที่">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="description">รายละเอียดที่อยู่เพิ่มเติม</label>
                                <textarea class="form-control" id="description" rows="5">

                                </textarea>
                            </div>

                            <div class="card-action">
                                <button class="btn btn-success">บันทึก</button>
                                <button class="btn btn-danger">ยกเลิก</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
