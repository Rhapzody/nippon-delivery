@extends('back.layout.app')

@section('content')
    <h4 class="page-title"><span class="la la-clipboard"></span> จัดการผู้ใช้งาน</h4>
    <div class="row">
        <div class="col-md-12 bg-light border border-primary rounded p-2">

            @include('back.widget.nav-user')

            <hr>

            {{-- Search --}}
            <div class="input-group mt-2 mr-5 w-50" id="adv-search">
                <input value="{{($search_text)?$search_text:""}}" name="search_text" id="search_text" type="text" class="form-control h6 text-secondary" placeholder="ค้นหาผู้ใช้" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <select class="form-control ml-1" name="search_mode" id="search_mode">
                            <option {{($search_mode==0)?"selected":""}} value="0" >ทั้งหมด</option>
                            <option {{($search_mode==1)?"selected":""}}  value="1">ชื่อ</option>
                            <option {{($search_mode==2)?"selected":""}}  value="2">หน้าที่</option>
                            <option {{($search_mode==3)?"selected":""}}  value="3">รหัส</option>
                            <option {{($search_mode==4)?"selected":""}}  value="4">email</option>
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
                            <th>ชื่อ-นามสกุล</th>
                            <th>email</th>
                            <th>หน้าที่</th>
                            <th width="8%">รายละเอียด</th>
                            <th width="8%">แก้ไข</th>
                            <th width="8%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->first_name . " " . $user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <a href="{{url('/staff/user/2') . "/" . $role->name}}">{{$role->name}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-outline-success big-icon" btn-s big-icon" onclick="getUserDetail({{$user->id}})"><span class="la la-search-plus"></span></button>
                                </td>
                                <td>
                                    <a href={{url('/staff/user/edit/') . "/" . $user->id}} class="btn btn-outline-primary btn-s big-icon" ><span class="la la-pencil-square"></span></a>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-s big-icon" onclick="deleteConfirm({{$user->id}})"><span class="la la-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
                <input type="hidden" name="noti_status" id="noti_status" value="{{Session::has('add-user-status')}}">
            </div>

            {{-- modal --}}
            <div class="modal fade border border-primarry" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียดผู้ใช้งาน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        {{-- content goes here --}}
                        <div class="row ml-4 pb-1">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 auto">
                                <img src="" id="modal-image" width="256px" height="256px" class="auto ml-2">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>รหัสผู้ใช้งาน : <span id="modal-id"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>ชื่อ-นามสกุล : <span id="modal-name"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>ชื่อผู้ใช้งาน : <span id="modal-username"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>หน้าที่ : <span id="modal-role"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>Email : <span id="modal-email"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>ตำบล : <span id="modal-sub-district"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>อำเภอ : <span id="modal-district"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>จังหวัด : <span id="modal-province"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>ถนน : <span id="modal-road"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>ซอย : <span id="modal-alley"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>หมู่ที่: <span id="modal-village"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>บ้านเลขที่ : <span id="modal-house"></span></h6>
                            </div>
                        </div>
                        <div class="row ml-4 pb-1">
                            <div class="col-md-12 auto">
                                <h6>ที่อยู่เพิ่มเติม : <span id="modal-add"></span></h6>
                            </div>
                        </div>
                        <a href="#" class="btn btn-success" id="modal-edit-but">แก้ไขข้อมูลผู้ใช้งาน</a>
                        <a href="#" class="btn btn-danger" id="modal-del-but">ลบผู้ใช้งาน</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

        //get user detail to modal
        let getUserDetail;
        //alert when delete user
        let deleteConfirm;

        $(function(){

            getUserDetail =  function(id){
                let url = "{{url('/user_detail_by_id')}}";
                let rootUrl = "{{url('/')}}";
                $.get(url+"?user_id="+id, function(data, status){
                    $('#modal-image').attr('src', rootUrl + data.picturePath + data.pictureName);
                    $('#modal-name').html(sanitarize(data.firstName) + " " + sanitarize(data.lastName));
                    $('#modal-id').html(data.id);
                    $('#modal-username').html(sanitarize(data.username));
                    $('#modal-email').html(sanitarize(data.email));
                    $('#modal-province').html(data.province);
                    $('#modal-district').html(data.district);
                    $('#modal-sub-district').html(data.subDistrict);
                    $('#modal-road').html(sanitarize(data.road));
                    $('#modal-alley').html(sanitarize(data.alley));
                    $('#modal-village').html(sanitarize(data.villageNumber));
                    $('#modal-house').html(sanitarize(data.houseNumber));
                    $('#modal-role').html(...data.roles);
                    $('#modal-add').html(sanitarize(data.additionalAddress));
                    $('#modal-del-but').attr('onclick',`deleteConfirm(${data.id})`);
                    $('#modal-edit-but').attr('href', "{{url('/staff/user/edit/')}}" + `/${data.id}`);
                    $('#my-modal').modal();
                });
            }

            deleteConfirm = function(id){
                swal({
                    title: "แน่ใจหรือไม่",
                    text: "ผู้ใช้งานคนนี้จะถูกลบออก",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let delUrl = "{{url('/staff/user/')}}";
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
                        swal("ลบผู้ใช้เรียบร้อย", {
                            icon: "success"
                        });
                    }
                });
            }

            $("#search_submit").click(function(){
                let searchMode = $('#search_mode').val();
                let searchText = $('#search_text').val();
                window.location.href = "{{url('/staff/user')}}" + `/${searchMode}/${searchText}`;
            });

            //notify when add success
            let check = $('#noti_status').val() || false;
            if(check){
                var placementFrom = "bottom";
                var placementAlign = "right";
                var state = "success";
                var style = "withicon";
                var content = {};

                content.message = '{{Session::get("add-user-status")}}';
                content.title = 'สำเร็จ!!!';
                if (style == "withicon") {
                    content.icon = 'la la-bell';
                } else {
                    content.icon = 'none';
                }
                content.url = '/';
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
