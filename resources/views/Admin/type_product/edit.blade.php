@extends('admin')
@section('body.content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">{{$edittp->name}}
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                      
                        <div class="alert alert-danger" style="display: none;"> </div>
                      <div class="alert alert-success" style="display: none;"> </div>
                     
                        <form method="post" enctype="multipart/form-data">
                           @csrf
                            <div class="form-group">
                                <label>Loại sản phẩm :</label>
                                <input type="text" class="form-control" value="{{$edittp->name}}" name="name" placeholder="Please Enter Type product Name" required/>
                            </div>
                            <div class="form-group">
                                <label>Mô tả :</label>
                                <input type="text" class="form-control" value="{{$edittp->description}}"  name="description" placeholder="Please Enter Description"  required/>
                            </div>
                            <div class="form-group">
                                <label>Ảnh cũ :</label>
                                <img src="{{asset('source/image/product/'.$edittp->image)}}" height="250" width="300">
                            </div> 
                            <div class="form-group">
                                <label>Ảnh mới (nếu cần):</label>
                                <input type="file" class="form-control" name="image" />
                            </div>
                            <button  class="gui btn btn-primary" data-id="{{$edittp->id}}">Sửa</button>
                            <button type="reset" class="btn btn-danger">Nhập lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('.gui').click(function(e){
           $.ajaxSetup({
             'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            });
            e.preventDefault();
            var id = $(this).data("id");
            var formData = new FormData(this);
            $.ajax({
                url: 'admin/type_product/postedit/'+id,
                type: 'POST',
                dataType: 'json',
                data: {formData,id: id},
                contentType: false,
                processData: false
            })
            .done(function(ketqua) {
                console.log(ketqua.thongbao);

            })
            .fail(function() {
              console.log('lỗi rồi mày ');
            })
            .always(function() {
                console.log("complete");
            });
            
        });
    });
</script>
