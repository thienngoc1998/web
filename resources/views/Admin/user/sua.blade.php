@extends('admin')
@section('body.content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa User
                        <small>{{$usercantim->id}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

                    <form enctype="multipart/form-data" method="post" id="data" action="">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="txtEmail" value="{{$usercantim->email}}"
                                   placeholder="Please Enter Email" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Tên:</label>
                            <input class="form-control" id="txtUser" value="{{$usercantim->username}}" type="text"/>
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            @if($usercantim->role==1)
                            <label class="radio-inline">
                                <input class="admin" id="role" name="rdoLevel" value="1" checked=""
                                       type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input class="member" id="role" name="rdoLevel" value="0" type="radio">Thành
                                viên
                            </label>
                            @else
                                <label class="radio-inline">
                                    <input class="admin" id="role" name="rdoLevel" value="1"
                                           type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input class="member" id="role" checked="" name="rdoLevel" value="0" type="radio">Thành
                                    viên
                                </label>
                             @endif
                        </div>
                        <button type="button" class="btn btn-primary" onclick="suauser({{$usercantim->id}})">Sửa</button>
                        <button type="reset" class="btn btn-danger">Nhập lại</button>
                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
<script>
    function suauser(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var username=$('#txtUser').val();
        var quyen=$('input[name=rdoLevel]:checked').val();

        $.ajax({
            url: 'admin/user/suauser/' + id,
            type: 'post',
            dataType: 'json',
            data: {id:id,username:username,role:quyen},
        })
            .done(function (Data) {
                toastr.success('Sửa thành công', 'Success Alert', {timeOut: 5000});
                $('#txtUser').val(Data.username);
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            })
    }
</script>