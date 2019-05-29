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
                    <input type="search" id="formtimkiem" class="form-control input-sm" placeholder=""
                           aria-controls="dataTables-example">
                </label>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Tên</th>
            <th>Loại sản phẩm</th>
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
        <tbody>
        @foreach($listproduct->all() as $ds)
            <tr class="odd gradeX" align="center" id="{{$ds->id}}">
                <td>{{$ds->id}}</td>
                <td>{{$ds->name}}</td>
                <td>{{$ds->producttype->name}}</td>
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
                    <button class="show-modal btn btn-success btn-sm" data-id="{{$ds->id}}" data-name="{{$ds->name}}"
                            data-catogory="{{$ds->producttype->name}}" data-unitpr="{{$ds->unit_price}}"
                            data-promo="{{$ds->promotion_price}}" data-unit="{{$ds->unit}}"
                            data-title="{{$ds->description}}" data-src="{{asset('source/image/product/'.$ds->image)}}">
                        <span class="glyphicon glyphicon-eye-open"></span> Show
                    </button>
                </td>
                <td class="center">
                    <button class="edit-modal btn btn-info btn-sm" data-id="{{$ds->id}}" data-name="{{$ds->name}}"
                            data-catogory="{{$ds->producttype->name}}" data-unit="{{$ds->unit_price}}"
                            data-promo="{{$ds->promotion_price}}" data-unit="{{$ds->unit}}"
                            data-title="{{$ds->description}}" data-src="{{asset('source/image/product/'.$ds->image)}}">
                        <span class="glyphicon glyphicon-edit "></span> Edit
                    </button>
                </td>
                <td class="center">
                    <button class="delete-modal btn btn-danger btn-sm" data-id="{{$ds->id}}" data-name="{{$ds->name}}"
                            onclick="xoasanpham({{$ds->id}})" data-catogory="{{$ds->producttype->name}}"
                            data-unit="{{$ds->unit_price}}" data-promo="{{$ds->promotion_price}}"
                            data-unit="{{$ds->unit}}" data-title="{{$ds->description}}"
                            data-src="{{asset('source/image/product/'.$ds->image)}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>
<!-- /.row -->
{{$listproduct->links()}}