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
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Link ảnh</th>
                                <th>Tên ảnh</th>
                                <th>Show</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listslide->all() as $ls)
                            <tr class="odd gradeX" align="center" id="{{$ls->id}}">
                                <td>{{$ls->id}}</td>
                                <td>{{$ls->link}}</td>
                                <td>{{$ls->image}}</td>
                                <td class="center">
                                    <button class="show-modal btn btn-success btn-sm" data-id="{{$ls->id}}"  data-link="{{$ls->link}}"  data-src="{{asset('source/image/product/'.$ls->image)}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                </td>
                                <td class="center">
                                    <a href="{{route('editslide',$ls->id)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-edit "></span> Edit</a>

                                </td>
                                <td class="center">
                                    <button class="delete-modal btn btn-danger btn-sm" data-id="{{$ls->id}}" data-link="{{$ls->link}}"  data-src="{{asset('source/image/product/'.$ls->image)}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    {{--showmodal--}}
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
                            <label class="control-label col-sm-2" for="name">Link:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link_show" disabled>
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
    {{--editmodal--}}
    {{--deletemodal--}}
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Bạn có chắc chắn muốn xóa không?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_delete" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Link ảnh :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link_delete" disabled>
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
                        <button type="button"  class="btn btn-danger delete" id="xoa" data-id="" data-dismiss="modal" onclick="xoaslide()">
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
        $('#changeimage').change(function () {
            if ($(this).is(':checked'))
            {
                $('.anh').show();
            }
            else
            {
                $('.anh').css('display','none');
            }
        });

        $('.edit').click(function () {
            var id = document.getElementById("layid").attributes[3].value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: 'admin/slide/edit/' + id,
                type: 'post',
                dataType: 'json',
                data: {id:id,formData},
                cache: false,
                contentType: false,
                processData: false


            })
                .done(function (Data) {
                    console.log(Data);
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                })
        });
    });

    $(document).on('click', '.show-modal', function() {
        $('.modal-title').text('Show');
        $('#id_show').val($(this).data('id'));
        $('#link_show').val($(this).data('link'));
        $('#tuyen').attr('src',$(this).data('src'));
        $('#showModal').modal('show');
    });
    //xóa
    $(document).on('click', '.delete-modal', function() {
        $('.modal-title').text('Delete');
        $('#id_delete').val($(this).data('id'));
        $('#link_delete').val($(this).data('link'));
        $('#img-delete').attr('src',$(this).data('src'));
        $("#xoa").attr("data-id",$(this).data('id'));
        $('#deleteModal').modal('show');
    });

    function xoaslide() {
        var id =document.getElementById("xoa").attributes[3].value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: 'admin/slide/delete/'+id,
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

function suaslide() {
             var id = document.getElementById("layid").attributes[3].value;
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
                 var formData = new FormData(this);
                 alert(id);
                 $.ajax({
                     url: 'admin/slide/edit/' + id,
                     type: 'post',
                     dataType: 'json',
                     data: {id:id,formData},
                     cache: false,
                     contentType: false,
                     processData: false


                 })
                     .done(function (Data) {
                         console.log(Data);
                     })
                     .fail(function () {
                         console.log("error");
                     })
                     .always(function () {
                         console.log("complete");
                     })



         }

</script>



