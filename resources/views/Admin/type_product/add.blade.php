@extends('admin')
@section('body.content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Type_product
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <div class="alert alert-success" style="display: none;"></div>
                    <div class="loi"></div>

                    <form enctype="multipart/form-data" method="post" id="data" action="">
                        @csrf
                        <div class="form-group">
                            <label>Loại sản phẩm :</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Please Enter Type product Name" required/>
                            @if($errors->has("name"))
                                <span class="error-text">
                                    {{$errors->first('name')}}
                                  </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Mô tả :</label>
                            <input type="text" class="form-control" id="description" name="description"
                                   placeholder="Please Enter Description" required/>
                            @if($errors->has("description"))
                                <span class="error-text">
                                    {{$errors->first('description')}}
                                  </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ảnh :</label>
                            <input type="file" class="form-control" id="image" name="image" required/>
                            @if($errors->has("image"))
                                <span class="error-text">
                                    {{$errors->first('image')}}
                                  </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary gui">Thêm</button>
                        <button type="reset" class="btn btn-danger">Nhập lại</button>
                        </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('form#data').submit(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                url: '{{route("postaddtype_product")}}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function (ketqua) {
                    toastr.success('Thêm thành công rồi ', 'Success Alert', {timeOut: 5000});
                    $('#name').val('');
                    $('#description').val('');
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