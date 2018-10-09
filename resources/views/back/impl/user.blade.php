@extends('back.layout.app')

@section('content')
    <h4 class="page-title"><span class="la la-clipboard"></span> จัดการผู้ใช้งาน</h4>
    <div class="row">
        <div class="col-md-12 bg-light border border-primary rounded p-2">

            @include('back.widget.nav-user')

            <hr>

            {{-- Search --}}
            <div class="input-group mt-2 mr-5 w-50" id="adv-search">
                <input type="text" class="form-control h6 text-secondary" placeholder="ค้นหาผู้ใช้" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <select class="form-control ml-1">
                            <option value="0" selected>ทั้งหมด</option>
                            <option value="1">ชื่อ</option>
                            <option value="2">หน้าที่</option>
                            <option value="3">รหัส</option>
                        </select>
                        <button type="button" class="btn btn-primary ml-1"><span class="la la-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>


            {{-- Table --}}
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>email</th>
                            <th>หน้าที่</th>
                            <th width="8%">รายละเอียด</th>
                            <th width="8%">แก้ไข</th>
                            <th width="8%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#">พีรทัต มันทะกะ</a></td>
                            <td><a href="">peeratat1995@gmail.com</a></td>
                            <td><a href="">เจ้าของร้าน</a></td>
                            <td>
                                <button class="btn btn-success btn-s" data-toggle="modal" data-target="#my-modal"><span class="la la-search-plus"></span></button>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-s"><span class="la la-pencil-square"></span></button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-s"><span class="la la-trash"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- modal --}}
            <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="container-fluid pt-3">
                            {{-- content goes here --}}
                            <h4>ชื่อผู้ใช้งาน</h4>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <img src="/img/product01.png" alt="">
                                </div>
                                <div class="col-6">
                                    <h6>รายละเอียด: </h6>
                                    <p>adsasd</p>
                                    <h6>เจ้าของร้าน</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
