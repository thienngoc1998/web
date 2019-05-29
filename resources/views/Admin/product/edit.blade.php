@extends('admin')
@section('body.content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$product->name}}
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

                    <form action="{{Route('postedit',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm:</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="Please Enter Type product Name" value="{{$product->name}}" required/>
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm :</label>
                            @foreach($loaisp->all() as $lsp)
                                @if($lsp->id==$product->id_type)
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" value="{{$lsp->id}}"
                                                      checked>{{$lsp->name}}</label>
                                    </div>
                                @else
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" value="{{$lsp->id}}">{{$lsp->name}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Mô tả :</label>
                            <input type="text" class="form-control" name="description"
                                   placeholder="Please Enter Description" value="{{$product->description}}"/>
                        </div>
                        <div class="form-group">
                            <label>Giá :</label>
                            <input type="text" class="form-control" name="unit_price"
                                   placeholder="Please Enter Unit_price" value="{{$product->unit_price}}" required/>
                        </div>
                        <div class="form-group">
                            <label>Giá khuyến mãi(nếu có):</label>
                            <input type="text" value="{{$product->promotion_price}}" class="form-control"
                                   name="promotion_price" placeholder="Please Enter promotion_price"/>
                        </div>
                        <div class="form-group">
                            @if(strcmp($product->unit,'hộp')==0)
                                <label>Hình thức bán:</label>
                                <div class="radio ">
                                    <label><input type="radio" name="bantheo" value="hộp" checked>Hộp</label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="bantheo" value="Cái">Cái</label>
                                </div>
                            @else
                                <div class="radio ">
                                    <label><input type="radio" name="bantheo" value="hộp">Hộp</label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="bantheo" value="Cái" disabled checked>Cái</label>
                                </div>

                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tình trạng:</label>
                            @if($product->new==1)
                                <div class="radio ">
                                    <label><input type="radio" name="tinhtrang" value="1" checked>Mới</label>
                                </div>
                                <div class="radio ">
                                    <label><input type="radio" name="tinhtrang" value="0">Cũ</label>
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Ảnh :</label>
                            <input type="file" class="form-control" name="image"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
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
    $(document).ready(function () {
        $('.btn-primary').click(function (e) {
            $.ajaxSetup({
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            });
            e.preventDefault();
            var formdata = new Formdata(this);
            $$.ajax({
                url: '',
                type: 'default GET (Other values: POST)',
                dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                data: {param1: 'value1'},
            })
                .done(function () {
                    console.log("success");
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });

        });
    });
</script>