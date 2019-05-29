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
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <label style="margin-right: 56px;    margin-top: 54px;">Search:
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
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Giá gốc</th>
                        <th>Giá khuyến mãi</th>
                        <th>Ảnh</th>
                        <th>Hình thức bán:</th>
                        <th>Tình trạng</th>
                        <th>Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="themcot">
                    @foreach($listproduct->all() as $ds)
                        <tr class="odd gradeX" align="center" id="{{$ds->id}}">
                            <td>{{$ds->id}}</td>
                            <td>{{$ds->name}}</td>
                            <td>{{$ds->description}}</td>
                            <td>{{$ds->unit_price}}</td>
                            <td>{{$ds->promotion_price}}</td>
                            <td>{{$ds->image}}</td>
                            <td>{{$ds->unit}}</td>
                            @if($ds->new==1)
                                <td>Mới</td>
                            @else
                                <td>Cũ</td>
                            @endif
                            <td class="center">
                                <button class="show-modal btn btn-success btn-sm" data-id="{{$ds->id}}"  data-name="{{$ds->name}}" data-catogory="{{$ds->producttype->name}}"  data-unitpr="{{$ds->unit_price}}" data-promo="{{$ds->promotion_price}}"  data-unit="{{$ds->unit}}"   data-title="{{$ds->description}}" data-src="{{asset('source/image/product/'.$ds->image)}}">
                                    <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                            </td>
                            <td class="center">
                                <a href="{{route('editproduct',$ds->id)}}" class="btn btn-info btn-sm"><span
                                            class="glyphicon glyphicon-edit "></span>Edit</a>
                            </td>
                            <td class="center">
                                <button class="delete-modal btn btn-danger btn-sm" data-id="{{$ds->id}}" onclick="xoasanpham({{$ds->id}})" data-name="{{$ds->name}}" data-catogory="{{$ds->producttype->name}}"  data-unit="{{$ds->unit_price}}" data-promo="{{$ds->promotion_price}}"  data-unit="{{$ds->unit}}"   data-title="{{$ds->description}}" data-src="{{asset('source/image/product/'.$ds->image)}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.row -->
            {{$listproduct->links()}}
        </div>

        <!-- /.container-fluid -->
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
                                <label class="control-label col-sm-2" for="name">Tên :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Loại sản phẩm:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="producttype_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Mô tả:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="decreption_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Giá gốc:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="unit_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Giá khuyến mãi :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="promotion_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Hình thức bán:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="hinhthuc" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Tình trạng:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="new_show" disabled>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(window).on('hashchange', function () {
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    } else {
                        getPosts(page);
                    }
                }
            });
            $(document).ready(function () {
                $(document).on('click', '.pagination a', function (e) {
                    getPosts($(this).attr('href').split('page=')[1]);
                    e.preventDefault();
                });

            });
            function getPosts(page) {
                $.ajax({
                    url: 'admin/product/list?page=' + page,
                    dataType: 'json',
                }).done(function (kq) {
                    $('.container-fluid').html(kq);
                    location.hash = page;
                }).fail(function () {
                    alert('Posts could not be loaded.');
                });
            }

            $(document).on('click', '.show-modal', function() {
                $('.modal-title').text('Show');
                $('#id_show').val($(this).data('id'));
                $('#name_show').val($(this).data('name'));
                $('#producttype_show').val($(this).data('catogory'));
                $('#decreption_show').val($(this).data('title'));
                $('#unit_show').val($(this).data('unitpr'));
                if ($(this).data('promo')==0)
                {
                    $('#promotion_show_show').remove();
                }
                else
                {
                    $('#promotion_show_show').val($(this).data('promo'));
                }
                $('#hinhthuc').val($(this).data('unit'));
                $('#tuyen').attr('src',$(this).data('src'));
                $('#showModal').modal('show');
            });

            function xoasanpham(id) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: 'admin/product/delete/'+id,
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
            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"{{ route('timkiem') }}",
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
        </script>

    </div>
@endsection