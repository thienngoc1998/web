@extends('admin')
@section('body.content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Add</small>
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
                        <form action="{{route('postadd')}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                                <label>Tên sản phẩm:</label>
                                <input type="text" class="form-control" name="name" placeholder="Please Enter Type product Name" required/>
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm :</label>
                                <div class="radio">
                                  <label><input type="radio" name="optradio" value="1" checked>Bánh ngọt</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="optradio"value="2">Bánh mặn</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="optradio"value="3" >Bánh Kem</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="optradio"value="4" >Bánh trái cây</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="optradio"value="5">Bánh crepe</label>
                                </div>
                                <div class="radio ">
                                  <label><input type="radio" name="optradio"value="6" >bánh Pizza</label>
                                 </div>
                                 <div class="radio ">
                                  <label><input type="radio" name="optradio"value="7" >bánh Su kem</label>
                                 </div>

                            </div>
                            <div class="form-group">
                                <label>Mô tả :</label>
                                <input type="text" class="form-control" name="description" placeholder="Please Enter Description"  required/>
                            </div>
                             <div class="form-group">
                                <label>Giá :</label>
                                <input type="text" class="form-control" name="unit_price" placeholder="Please Enter Unit_price"  required/>
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mãi(nếu có):</label>
                                <input type="text" class="form-control" name="promotion_price" placeholder="Please Enter promotion_price"  />
                            </div>
                             <div class="form-group">
                                <label>Hình thức bán:</label>
                                <div class="radio ">
                                  <label><input type="radio" name="bantheo"value="Hột" checked >Hộp</label>
                                 </div>
                                 <div class="radio ">
                                  <label><input type="radio" name="bantheo" value="Cái"  >Cái</label>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label>Tình trạng:</label>
                                <div class="radio ">
                                  <label><input type="radio" name="tinhtrang"value="1" checked >Mới</label>
                                 </div>
                                 <div class="radio disabled">
                                  <label><input type="radio" name="tinhtrang" value="0" disabled >Cũ</label>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh :</label>
                                <input type="file" class="form-control" name="image" required/>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm </button>
                            <button type="reset" class="btn btn-danger">Nhập lại</button>
                        <form>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
@endsection