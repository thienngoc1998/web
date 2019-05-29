@extends('admin')
@section('body.content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khách hàng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Sô điện thoại</th>
                                <th>Ghi chú</th>
                                <th>Xem đơn hàng</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->all() as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->name}}</td>
                                <td>{{$cm->gender}}</td>
                                <td>{{$cm->email}}</td>
                                <td>{{$cm->address}}</td>
                                <td>{{$cm->phone_number}}</td>
                                <td>{{$cm->note}}</td>
                                <td class="center">
                                    <button class="show-modal btn btn-success btn-sm" data-id="{{$cm->id}}" onclick="xemdonhang({{$cm->id}})">
                                        <span class="glyphicon glyphicon-eye-open"></span> Xem </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    <div id="modal_show" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center">
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Giá gốc</th>
                            <th>Ghi chú</th>
                            <th>Ngày đặt hàng </th>
                            <th>Hình thức thanh toán </th>
                            <th>Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody class="t1">
                            <tr class="odd gradeX" align="center" >

                            </tr>

                        </tbody>
                    </table>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

