@extends('back.layout.app')

@section('content')
    <style>
        .my-img-container {
            position: relative;
            width: 100%;
            max-width: 400px;
        }


        .my-img-container .my-img-btn {
            position: absolute;
            top: 0%;
            left: 100%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            color: red;
            background-color: rgba(0, 0, 0, 0);
            font-size: 18px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        .my-img-container .my-img-btn:hover {
            font-size: 26px;
        }

        .clearfix{
            display: block;
            clear: both;
        }
    </style>
    <h4 class="page-title"><span class="la la-clipboard"></span> จัดการสินค้า</h4>
    <div class="row">
        <div class="col-md-12 bg-light border border-primary rounded p-2">

            @include('back.widget.nav-product')

            <hr>

            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">แก้ไขรายละเอียดสินค้า รหัส: {{$menu->id}}</div>
                        </div>
                        <form class="card-body" id="edit-product" action={{url("staff/product/edit/process")}} method="POST" enctype="multipart/form-data">
                            @if(Session::has('message'))
                                <p class="text-success">{{ Session::get('message') }}</p>
                            @endif
                            <input type="hidden" name="id" value={{$menu->id}}>
                            <div class="form-group">
                                <label for="name">ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อสินค้า" value={{$menu->name}}>
                            </div>

                            <div class="form-group">
                                <label for="price">ราคา (บาท)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="ราคา" value={{$menu->price}} >
                            </div>

                            <div class="form-group">
                                <label for="type">ประเภท</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="-1">กรุณาเลือกประเภท</option>
                                    @foreach ($types as $type)
                                        <option value={{$type->id}} {{($menu->type_id == $type->id)?"selected":""}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-inline">
                                <label for="tag" class="mr-2">แท็ก</label>
                                <input list="tags" class="form-control mr-2 w-50" name="tag" id="tag" placeholder="แท็ก">
                                <datalist id="tags">
                                    <option data-tagid="-1">เพิ่มแท็ก</option>
                                    @foreach ($tags as $tag)
                                        <option value={{$tag->name}} data-tagid={{$tag->id}}>
                                    @endforeach
                                </datalist>
                                <input type="button" value="เพิ่ม" class="btn btn-outline-primary" id="add-tag">
                            </div>
                            <input type="hidden" name="tag_data" id="tag_data">
                            {{-- added tag lists --}}
                            <div id="show-tags">
                                {{-- show added tags here --}}
                            </div>

                            <div class="form-group">
                                    <label for="menu_image">รูปสินค้า</label>
                                    <input type="file" class="form-control-file" style="display:none;"  id="menu_image" name="menu_image[]" multiple accept="image/png, image/jpeg">
                                    <label for="menu_image" style="color:white;" class="btn btn-outline-primary"><span class="la la-image"></span> เลือกรูปภาพ</label>
                                    <input type="hidden" name="image_name" id="image_name">
                                    <input type="hidden" name="old_image_id" id="old_image_id">
                                </div>
                                <div class="" id="menu-img-group">
                                    {{-- show menu image --}}
                                </div>


                                <div class="form-group clearfix">
                                    <label for="description clearfix">คำอธิบายสินค้า</label>
                                    <textarea class="form-control" id="description" name="description" rows="5">{{$menu->description}}</textarea>
                                </div>
                                @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                            <div class="card-action">
                                @csrf
                                <button class="btn btn-success" id="edit-product-but">บันทึก</button>
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

        let deleteTag;
        let deleteImg;
        let deleteOldImg;

        $(function() {
            //validate
            $('#edit-product').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    type: {
                        required: true,
                        number: true,
                        min: 1,
                    },
                    'menu_image[]': {
                        extension: "png|jpeg|jpg"
                    }

                },
                messages: {
                    name: {
                        required: "กรุณาระบุชื่อสินค้า",
                        maxlength: "ชื่อสินค้าควรมีขนาดไม่เกิน 255 ตัวอักษร"
                    },
                    price: {
                        required: "กรุณาระบุราคาสินค้า",
                        number: "ราคาสินค้าควรเป็นตัวเลข"
                    },
                    type: {
                        required: 'กรุณาระบุประเภทสินค้า',
                        number: "ประเภทสินค้าไม่ถูกต้อง",
                        min: "กรุณาระบุประเภทสินค้า",
                    },
                    'menu_image[]': {
                        extension: "ไฟล์ต้องเป็นชนิด png, jpeg หรือ jpg"
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

            //image
            let imgArr = [];
            let oldImgArr = [];

            let myUrl = "{{url('staff/product/product_pictures_by_id')}}";
            let myRootUrl = "{{url('/')}}";
            $.get(myUrl + "?productId={{$menu->id}}",function(data, status) {
                data.menu_pictures.forEach(ele => {
                    let img = `
                                <div class="my-img-container pull-left mr-2 mt-2 old-image" style="width:150px;height:150px;" id="old-img-${ele.id}">
                                    <img src="${myRootUrl + '/storage/' + ele.name}" alt="product" width="150px" height="150px">
                                    <button type="button" class="my-img-btn btn-sm" href="#menu-img-group" onclick="deleteOldImg(${ele.id})">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        `;
                    $("#menu-img-group").append(img);
                });
                $('#old_image_id').val(JSON.stringify(oldImgArr));
            })

            $("#menu_image").change(function () {
                $('.product-image').remove();
                if (this.files && this.files[0]) {
                    imgArr = Array.from(this.files);
                    $(this.files).each(function (index) {
                        var reader = new FileReader();
                        reader.readAsDataURL(this);
                        reader.onload = function (e) {
                            let img = `
                                <div class="my-img-container pull-left mr-2 mt-2 product-image" style="width:150px;height:150px;" id="product-${index}">
                                    <img src="${e.target.result}" alt="product" width="150px" height="150px">
                                    <button type="button" class="my-img-btn btn-sm" href="#menu-img-group" onclick="deleteImg(${index})">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `;
                            $("#menu-img-group").append(img);
                            let imgObj = [];
                            imgArr.forEach(ele => {
                                imgObj.push(ele.name);
                            });
                            $('#image_name').val(JSON.stringify(imgObj));
                        }
                    });
                }
            });

            deleteImg = function(imgIndex) {
                swal({
                    title: "แน่ใจหรือไม่",
                    text: "ต้องการจะลบภาพนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#product-'+imgIndex).remove();
                        delete imgArr[imgIndex];
                        let imgObj = [];
                        imgArr.forEach(ele => {
                            imgObj.push(ele.name);
                        });
                        $('#image_name').val(JSON.stringify(imgObj));
                    }
                });
            }

            deleteOldImg = function(id) {
                swal({
                    title: "แน่ใจหรือไม่",
                    text: "ต้องการจะลบภาพนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#old-img-'+id).remove();
                        oldImgArr.push(id);
                        $('#old_image_id').val(JSON.stringify(oldImgArr));
                    }
                });
            }

            //tag
            let tagsObj = [];
            let url = "{{url('staff/product/product_tags_by_id')}}";
            let rootUrl = "{{url('/')}}";
            $.get(url + "?productId={{$menu->id}}",function(data, status) {
                data.tags.forEach(ele => {
                    tagsObj.push([ele.id,ele.name]);
                    $('#show-tags').append(`<span class="badge badge-info" id="${ele.id}-${ele.name}" tagId="${ele.id}">${ele.name} <a href="#add-tag" onclick="deleteTag(${ele.id},'${ele.name}')" class="la la-close"></a></span>`);
                });
                $('#tag_data').val(JSON.stringify(tagsObj.filter(v=>(v!=null))));
            })

            $('#add-tag').click(function(params) {
                let tagName = sanitarize($('#tag').val());
                let tagId = $('#tags option').filter(function() {
                    return this.value == tagName;
                }).data('tagid');
                /* if value doesn't match an option,  will be 0*/
                if(!tagId) tagId = 0;
                let check = tagsObj.filter(element => {
                    return element[1] == tagName;
                });
                if(check.length == 0){ tagsObj.push([tagId,tagName]);}
                $('#show-tags').append(`<span class="badge badge-info" id="${tagId}-${tagName}" tagId="${tagId}">${tagName} <a href="#add-tag" onclick="deleteTag(${tagId},'${tagName}')" class="la la-close"></a></span>`);
                $('#tag_data').val(JSON.stringify(tagsObj.filter(v=>(v!=null))));
            });

            deleteTag = function(id, name){
                tagsObj.forEach((ele,index) => {
                    if(ele[0] == id && ele[1] == name){
                        delete tagsObj[index];
                    }
                });
                let idTag = `#${id}-${name}`;
                $(idTag).remove();
                $('#tag_data').val(JSON.stringify(tagsObj.filter(v=>(v!=null))));
            }
        })
        function sanitarize(string) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#x27;',
                "/": '&#x2F;',
            };
            const reg = /[&<>"'/]/ig;
            if (string) {
                return string.replace(reg, (match)=>(map[match]));
            } else {
                return null;
            }
        }
    </script>
@endsection
