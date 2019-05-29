@extends('admin')
@section('body.content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Thêm mới</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form enctype="multipart/form-data" method="post" id="data" action="">
                        @csrf
                        <div class="form-group">
                            <label>Link :</label>
                            <input type="text" class="form-control" name="link" id="link" placeholder="Please Enter Link"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label>Ảnh :</label>
                            <input type="file" class="form-control" name="image" required/>
                        </div>

                    <button type="submit" class="btn btn-primary">Thêm ảnh</button>
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                url: '{{route("postadd")}}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function (ketqua) {
                    toastr.success('Thêm thành công rồi ', 'Success Alert', {timeOut: 5000});
                    $('#link').val('');

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