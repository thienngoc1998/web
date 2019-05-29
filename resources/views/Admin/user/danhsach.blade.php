@extends('admin')
@section('body.content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success" style="display: none"></div>
                    <h1 class="page-header">Slide
                        <small>Danh sách</small>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <label style="margin-right: 56px;">Search:
                                <input type="search"  id="formtimkiem"  class="form-control input-sm" placeholder=""
                                       aria-controls="dataTables-example">
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>TÊN</th>
                        <th>EMAIL</th>
                        <th>QUYỀN</th>
                        <th>SỬA</th>
                        <th>XÓA</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachuser->all() as $list)
                        <tr class="odd gradeX" align="center" id="{{$list->id}}">
                            <td>{{$list->id}}</td>
                            <td>{{$list->username}}</td>
                            <td>{{$list->email}}</td>
                            @if($list->role==0)
                                <td>Thành viên</td>
                            @else
                                <td>Admin</td>
                            @endif
                            <td class="center">
                                <a href="{{route('getsua',$list->id)}}" class="btn btn-primary btn-sm"><span
                                            class="glyphicon glyphicon-edit "></span>Edit</a>
                            </td>
                            <td class="center">
                                <button class="delete-modal btn btn-danger btn-sm" data-id="{{$list->id}}"
                                        data-name="{{$list->username}}" data-email="{{$list->email}}"
                                        data-role="{{$list->role}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>

        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Bạn có chắc chắn muốn xóa không?</h3>
                        <br/>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id">ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id_delete" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Tên:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="content">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" disabled>
                                </div>
                            </div>

                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete" id="xoa" data-id="" data-dismiss="modal"
                                    onclick="xoauser()">
                                <span id="" class='glyphicon glyphicon-trash'></span> Delete
                            </button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        fetch_customer_data();

        function fetch_customer_data(query = '')
        {
            $.ajax({
                url:"{{ route('timkiemuser') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data)
                {
                    $('tbody').html(data.table_data);

                }
            })
        }
        $(document).on('keyup', '#formtimkiem', function(){
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });
    //xóa
    $(document).on('click', '.delete-modal', function () {
        $('.modal-title').text('Delete');
        $('#id_delete').val($(this).data('id'));
        $('#username').val($(this).data('name'));
        $('#email').attr('src', $(this).data('email'));
        $("#xoa").attr("data-id", $(this).data('id'));
        $('#deleteModal').modal('show');
    });

    function xoauser() {
        var id = document.getElementById("xoa").attributes[3].value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: 'admin/user/xoa/' + id,
            type: 'get',
            dataType: 'json',
            data: {id: id},
        })
            .done(function (Data) {
                toastr.success('Xóa thành công rồi ', 'Success Alert', {timeOut: 5000});
                $('#' + id).remove();
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    }

</script>



