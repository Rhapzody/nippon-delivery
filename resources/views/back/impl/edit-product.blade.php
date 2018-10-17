@extends('back.layout.app')

@section('content')
    <h4 class="page-title"><span class="la la-clipboard"></span> จัดการสินค้า</h4>
    <div class="row">
        <div class="col-md-12 bg-light border border-primary rounded p-2">

            @include('back.widget.nav-product')

            <hr>

            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">แก้ไขรายละเอียดสินค้า รหัส: 1</div>
                        </div>
                        <form class="card-body" action="" method="POST" >

                            <div class="form-group">
                                <label for="email">ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="name" placeholder="ชื่อสินค้า">
                            </div>

                            <div class="form-group">
                                <label for="price">ราคา (บาท)</label>
                                <input type="number" class="form-control" id="price" placeholder="ราคา">
                            </div>

                            <div class="form-group">
                                <label for="type">ประเภท</label>
                                <input list="types" class="form-control" id="type" placeholder="ประเภท">
                                <datalist id="types">
                                    <option value="Internet Explorer">
                                    <option value="Firefox">
                                </datalist>
                            </div>

                            <div class="form-group form-inline">
                                <label for="tag" class="mr-2">แท็ก</label>
                                <input list="tags" class="form-control mr-2 w-50" id="tag" placeholder="แท็ก">
                                <datalist id="tags">
                                    <option value="Internet Explorer">
                                    <option value="Firefox">
                                </datalist>
                                <input type="button" value="เพิ่ม" class="btn btn-info">
                            </div>
                            {{-- added tag lists --}}
                            <div>
                                <span class="badge badge-info">มะละกอ <a href="#" class="la la-close"></a></span>
                            </div>

                            <div class="form-group">
                                <label for="menu-image">รูปสินค้า</label>
                                <input type="file" class="form-control-file"  id="menu-image">
                            </div>

                            <div>
                                <img src="/img/product01.png" alt="">
                            </div>

                            <div class="form-group">
                                <label for="description">คำอธิบายสินค้า</label>
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
