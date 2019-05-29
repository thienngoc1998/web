@extends('admin')
@section('body.content')
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Loại sản phẩm
                        <small>Danh sách</small>
                    </h1>
                </div>
                <div class="col-lg-6">
                    <div class="input-group " style="    padding-top: 50px;">
                        <input type="text" class="form-control" id="formtimkiem" placeholder="Search...">
                        <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" >
                                        <i class="fa fa-search"></i>
                                    </button>
                        </span>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Ảnh</th>
                        <th>Xem chi tiết</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($type_product as $tp)
                        <tr class=" odd gradeX" align="center" id="{{$tp->id}}">
                            <td>{{$tp->id}}</td>
                            <td>{{$tp->name}}</td>
                            <td>{{$tp->description}}</td>
                            <td>{{$tp->image}}</td>
                            <td class="center">
                                <button class="show-modal btn btn-success btn-sm" data-id="{{$tp->id}}"  data-name="{{$tp->name}}" data-title="{{$tp->description}}" data-src="{{asset('source/image/product/'.$tp->image)}}">
                                    <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                            </td>
                            <td class="center">
                                <button class="edit-modal btn btn-info btn-sm" data-id="{{$tp->id}}"  data-name="{{$tp->name}}" data-title="{{$tp->description}}" data-src="{{asset('source/image/product/'.$tp->image)}}">
                                    <span class="glyphicon glyphicon-edit "></span> Edit</button>
                            </td>
                            <td class="center">
                                <button class="delete-modal btn btn-danger btn-sm" data-id="{{$tp->id}}" data-name="{{$tp->name}}" data-title="{{$tp->description}}" data-src="{{asset('source/image/product/'.$tp->image)}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
            <!-- /.row -->

            <div id="showModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="title">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="decreption_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Ảnh cũ:</label>
                                    <div class="col-sm-10">
                                            <img src="" id="tuyen" height="100" width="150">

                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_edit" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_edit" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="title">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="decreption_edit" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Ảnh cũ:</label>
                                    <div class="col-sm-10">
                                        <img src="" id="anhcu" height="75px" width="75px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Ảnh mới (Nếu cần):</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="image">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary edit" id="layid" data-id="" onclick="suatypeproduct()"  data-dismiss="modal">
                                    <span class='glyphicon glyphicon-check'></span> Edit
                                </button>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="deleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-center">Are you sure you want to delete the following post?</h3>
                            <br />
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Tên :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="title">Mô tả:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="decreption_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Ảnh cũ:</label>
                                    <div class="col-sm-10">
                                        <img src="" id="img-delete" height="100" width="150">

                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger delete" id="xoa" data-id="" data-dismiss="modal" onclick="xoatype()">
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
        <!-- /.container-fluid -->
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>


    fetch_customer_data();

    function fetch_customer_data(query = '')
    {
        $.ajax({
            url:"{{ route('timkiemtypeproduct') }}",
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
   //delete

   //show modal
   $(document).on('click', '.show-modal', function() {
       $('.modal-title').text('Show');
       $('#id_show').val($(this).data('id'));
       $('#name_show').val($(this).data('name'));
       $('#decreption_show').val($(this).data('title'));
       $('#tuyen').attr('src',$(this).data('src'));
       $('#showModal').modal('show');
   });
   //edit modal

   $(document).on('click', '.edit-modal', function() {
       $('.modal-title').text('Edit');
       $('#id_edit').val($(this).data('id'));
       $('#name_edit').val($(this).data('name'));
       $('#decreption_edit').val($(this).data('title'));
       $('#anhcu').attr('src',$(this).data('src'));
       $("#layid").attr("data-id",$(this).data('id'));
       $('#editModal').modal('show');
   });
   $(document).on('click', '.delete-modal', function() {
       $('.modal-title').text('Delete');
       $('#id_delete').val($(this).data('id'));
       $('#name_delete').val($(this).data('title'));
       $('#decreption_delete').val($(this).data('title'));
       $('#img-delete').attr('src',$(this).data('src'));
       $("#xoa").attr("data-id",$(this).data('id'));
       $('#deleteModal').modal('show');


   });

    function xoatype() {
        var id =document.getElementById("xoa").attributes[3].value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: 'admin/type_product/delete/'+id,
            type: 'get',
            dataType: 'json',
            data: {id: id},

        })
            .done(function(Data) {
                toastr.success('Xóa thành công rồi ', 'Success Alert', {timeOut: 5000});
                $('#'+id).remove();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    }




</script>