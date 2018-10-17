@extends('back.layout.app')

@section('content')
    <h4 class="page-title"> <span class="la la-clipboard"></span>จัดการสินค้า</h4>
    <div class="row">
        <div class="col-md-12 bg-light border border-primary rounded p-2">

            @include('back.widget.nav-product')

            <hr>

            {{-- Search --}}
            <div class="input-group mt-2 mr-5 w-50" id="adv-search">
                <input value="{{($search_text)?$search_text:""}}" name="search_text" id="search_text" type="text" class="form-control h6 text-secondary" placeholder="ค้นหาเมนูสินค้า" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <select class="form-control ml-1" name="search_mode" id="search_mode">
                            <option {{($search_mode==0)?"selected":""}} value="0" >ทั้งหมด</option>
                            <option {{($search_mode==1)?"selected":""}}  value="1">ชื่อ</option>
                            <option {{($search_mode==2)?"selected":""}}  value="2">ประเภท</option>
                            <option {{($search_mode==3)?"selected":""}}  value="3">รหัส</option>
                            <option {{($search_mode==4)?"selected":""}}  value="4">แท็ก</option>
                        </select>
                        <button id="search_submit" class="btn btn-primary ml-1"><span class="la la-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>


            {{-- Table --}}
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อเมนู</th>
                            <th>ประเภท</th>
                            <th>แท็ก</th>
                            <th width="8%">รายละเอียด</th>
                            <th width="8%">แก้ไข</th>
                            <th width="8%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <td>{{$menu->id}}</td>
                            <td>{{$menu->name}}</td>
                            <td><a href="{{url('staff/product',['2',$menu->menuType->name])}}">{{$menu->menuType->name}}</a></td>
                            <td>
                                @foreach ($menu->tags as $tag)
                                    <a href="{{url('staff/product',['4',$tag->name])}}">{{$tag->name}}, </a>
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-outline-success big-icon" btn-s big-icon" onclick="getProductDetail({{$menu->id}})"><span class="la la-search-plus"></span></button>
                            </td>
                            <td>
                                <a href={{url('/staff/product/edit/') . "/" . $menu->id}} class="btn btn-outline-primary btn-s big-icon" ><span class="la la-pencil-square"></span></a>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-s big-icon" onclick="deleteConfirm({{$menu->id}})"><span class="la la-trash"></span></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $menus->links() }}
                <input type="hidden" name="noti_status" id="noti_status" value="{{Session::has('add-product-status')}}">
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container-fluid pt-3">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">รายละเอียดสินค้า</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     {{-- content goes here --}}
                    <div class="row py-3">
                        <div class="col-md-6">
                            <div id="demo" class="carousel slide" data-ride="carousel">

                                <!-- Indicators -->
                                <ul class="carousel-indicators" id="modal-indicator">
                                </ul>

                                <!-- The slideshow -->
                                <div class="carousel-inner bg-dark px-1 py-1 border border-danger rounded" id="modal-image">

                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre id="modal-data">
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        let deleteConfirm;
        let getProductDetail;

        $(function(){

            //search submitting
            $("#search_submit").click(function(){
                let searchMode = $('#search_mode').val();
                let searchText = $('#search_text').val();
                window.location.href = "{{url('/staff/product')}}" + `/${searchMode}/${searchText}`;
            });

            //notify when add success
            let check = $('#noti_status').val() || false;
            if(check){
                var placementFrom = "bottom";
                var placementAlign = "right";
                var state = "success";
                var style = "withicon";
                var content = {};

                content.message = '{{Session::get("add-product-status")}}';
                content.title = 'สำเร็จ!!!';
                if (style == "withicon") {
                    content.icon = 'la la-bell';
                } else {
                    content.icon = 'none';
                }
                content.url = 'index.html';
                content.target = '_blank';

                $.notify(content,{
                    type: state,
                    placement: {
                        from: placementFrom,
                        align: placementAlign
                    },
                    time: 1000,
                });
            }

            //delete confirm
            deleteConfirm = function(id){
                swal({
                    title: "แน่ใจหรือไม่",
                    text: "สินค้าเมนูนี้จะถูกลบออก",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let delUrl = "{{url('/staff/product/')}}";
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: delUrl + "/" + id,
                            type: 'DELETE',
                            success: function(result) {
                                location.reload();
                            }
                        });
                        swal("ลบสินค้า", {
                            icon: "success"
                        });
                    }
                });
            }

            //get product detail
            getProductDetail =  function(id){
                let url = "{{url('staff/product/product_detail_by_id')}}";
                let rootUrl = "{{url('/')}}";
                $.get(url+"?product_id="+id, function(data, status){
                    let id = data.id;
                    let name = sanitarize(data.name);
                    let descript = sanitarize(data.description);
                    let price = data.price;
                    let tags = data.tags; //[] .id .name
                    let pictures = data.menu_pictures; //[] .id .name
                    let type = data.menu_type; //.id .name
                    let picEle = $('#modal-image');
                    let indiEle = $('#modal-indicator');
                    let dataEle = $('#modal-data');
                    picEle.html("");
                    indiEle.html("");
                    dataEle.html(`
                        รหัสสินค้า ${id}
                        ชื่อสินค้า ${name}
                        คำอธิบายสินค้า ${descript}
                        ราคา ${price} บาท
                        ชนิดสิรค้า ${type.name}
                        แท็ก
                    `);
                    pictures.forEach((ele, index) => {
                        let isActive = (index == 0)?"active":"";
                        picEle.append(`
                            <div class="carousel-item ${isActive}">
                                <img src="${rootUrl + '/storage/' + ele.name}" alt="" style="display: block;margin-left: auto;margin-right: auto;width:480px;height:480px;"
                            </div>
                        `);
                        indiEle.append(`
                            <li data-target="#demo" data-slide-to="0" class="${isActive}"></li>
                        `);
                    });
                    $('#my-modal').modal();
                });
            }

        });

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
