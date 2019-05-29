@extends('admin')
@section('body.content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <div class="alert alert-success" style="display:none">

                    </div>
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên *</label>
                            <input class="form-control" name="username" placeholder="Please Enter Username" />
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu *</label>
                            <input type="password" class="form-control" name="password" placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>Xác nhận mật khẩu *</label>
                            <input type="password" class="form-control" name="corfimpassword" placeholder="Please Enter RePassword" />
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <label class="radio-inline">
                                <input name="rdoLevel" value="1" checked="" type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="rdoLevel" value="0" type="radio">Thành viên
                            </label>
                            <input type="hidden" name="provider" value="0">
                            <input type="hidden" name="provider_id" value="0">
                        </div>
                    </form>
                        <button type="submit" class="btn btn-primary" onclick="themuser()">Thêm thành viên</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <script type="text/javascript">

             function themuser() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var name = $("input[name=username]").val();
                var email = $("input[name=email]").val();
                var password = $("input[name=password]").val();
                var corfimpassword = $("input[name=corfimpassword]").val();
                var rdoLevel=$("input[name=rdoLevel]:checked").val();
                var provider=$("input[name=provider]").val();
                var provider_id=$("input[name=provider_id]").val();

                $.ajax({
                    url: '{{route('postthemuser')}}',
                    type: "POST",
                    data: {
                        username: name,
                        email: email,
                        password: password,
                        corfimpassword: corfimpassword,
                        provider:provider,
                        provider_id:provider_id,
                        role:rdoLevel,
                    },
                    dataType: 'json'
                })
                    .done(function (resuilt) {
                        $('.alert-success').html(resuilt);
                         $('.alert-success').css('display','block');
                         window.location.reload(true);
                    })
                    .fail(function (xhr) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#validation-errors').append('<div class="alert alert-danger"><p>' + value + '</p></div>');
                        });
                    })
                    .always(function () {
                        console.log("complete");
                    });

        }
    </script>
@endsection

	
	 
       
             
