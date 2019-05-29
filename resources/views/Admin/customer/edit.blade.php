@extends('admin')
@section('body.content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khách hàng:{{$idcansua->name}} 
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
                        <form action="" method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="form-group">
                                <label> Tên :</label>
                                <input type="text" class="form-control" value="{{$idcansua->name}}" name="name" placeholder="Please Enter Link" required/>
                            </div>
                            <div class="form-group">
                                <label> Giới tính:</label>
                                @if(strcmp($idcansua->gender,'Nam')==0)
                                  <div class="radio disabled">
                                  <label><input type="radio" name="gioitinh"value="Nam" checked >Nam</label>
                                 </div>
                                 <div class="radio ">
                                  <label><input type="radio" name="gioitinh" value="Nữ" >Nữ</label>
                                 </div>
                                 @else
                                 <div class="radio disabled">
                                  <label><input type="radio" name="gioitinh"value="Nữ" checked >Nữ</label>
                                 </div>
                                 <div class="radio ">
                                  <label><input type="radio" name="gioitinh" value="Nam" >Nam</label>
                                 </div>
                                 @endif
                            </div>
                            <div class="form-group">
                                <label> Email :</label>
                                <input type="email" class="form-control"  value="{{$idcansua->email}}"  name="email" placeholder="Please Enter Link" required/>
                            </div>
                            <div class="form-group">
                                <label> Địa chỉ :</label>
                                <input type="text" class="form-control"  value="{{$idcansua->address}}" name="address" placeholder="Please Enter Link" required/>
                            </div>
                            <div class="form-group">
                                <label> Số điện thoại :</label>
                                <input type="text" class="form-control"  value="{{$idcansua->phone_number}}"  name="phone_number" placeholder="Please Enter Link" required/>
                            </div>
                            <div class="form-group">
                                <label> Ghi chú :</label>
                                <input type="text" class="form-control"  value="{{$idcansua->note}}"  name="note" placeholder="Please Enter Link" required/>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Sửa khách hàng</button>
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