@extends('admin')
@section('body.content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide cần sửa :{{$idcansua->id}}
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                      @if(count($errors)>0)
                        <div class="alert alert-danger">
                        	<h1>ERORR:</h1>
                        	<ul>
                        		@foreach($errors->all() as $err)
                        		<li>{{$err}}</li>
                        		@endforeach
                        	</ul>
                        </div>
                      @endif
                      @if(Session('thongbao'))
                      <div class="alert alert-success">
                      	{{Session('thongbao')}}
                      </div>
                      @endif
                        <form enctype="multipart/form-data" method="post" id="data" action="">
                           @csrf
                            <div class="form-group">
                                <label>Link :</label>
                                <input type="text" class="form-control" id="link" name="link"  value="{{$idcansua->link}}" required/>
                            </div>
                            <div class="form-group">
                                <label>Ảnh cũ :{{$idcansua->image}}</label>
                                <img src="{{asset('/source/image/slide/'.$idcansua->image)}}"  height="350" width="575">
                            </div>
                            <div class="form-group">
                                <label>Ảnh mới :</label>
                                <input type="file" class="form-control" name="image" />
                            </div>

                            <button type="submit" id="layid" class="btn btn-primary" data-id="{{$idcansua->id}}">Sửa</button>
                            <button type="reset" class="btn btn-danger">Nhập lại</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- /#page-wrapper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $('form#data').submit(function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    var formData =$('#data').serialize();
                    var id = document.getElementById("layid").attributes[3].value;
                    console.log(formData);
                    $.ajax({
                        url: 'admin/slide/editslide/' + id,
                        type: 'post',
                        dataType: 'json',
                        data: {id:id,formData},
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                        .done(function (ketqua) {
                            toastr.success('Thêm thành công rồi ', 'Success Alert', {timeOut: 5000});
                        })
                        .fail(function (xhr) {
                            $('.loi').html('');
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('.loi').append('<div class="alert alert-danger"><ul><li>' + value + '</li></ul></div>');
                            });
                        })
                        .always(function () {
                            console.log("complete");
                        });

                });
            });
        </script>
@endsection
