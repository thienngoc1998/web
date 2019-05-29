function suatypeproduct() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = document.getElementById('layid').attributes[3].value;
    var fd = new FormData();
    var files = $('#image')[0].files[0];
    fd.append('file', files);

    console.log(fd);
    $.ajax({
        url: 'admin/type_product/postedit',
        type: 'POST',
        dataType: 'json',
        data: {fd, id: id},


    })
        .done(function (ketqua) {

            console.log('thành công rồi ');
        })
        .fail(function () {
            console.log('lỗi rồi mày ');
        })
        .always(function () {
            console.log("complete");
        });

}

function ajaxmodal(id) {
    $.ajaxSetup({
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    });

    $.ajax({
        url: 'admin/type_product/ajaxmodal/' + id,
        type: 'get',
        dataType: 'json',
        data: {id: id},

    })
        .done(function (ketqua) {
            $('#name').val(ketqua.name);
            $('#description').val(ketqua.description);
            $("#tuyen").attr("src", "source/image/product/" + ketqua.image);
            $("#gui").attr("data-id", ketqua.id);
            $("#myModal").show("modal");

        })
        .fail(function () {
            console.log('lỗi rồi mày ');
        })
        .always(function () {
            console.log("complete");
        });

};

function deletexxx() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = document.getElementById('xoa').attributes[3].value;
    $.ajax({
        url: 'admin/type_product/delete/' + id,
        type: 'get',
        dataType: 'json',
        data: {id: id},

    })
        .done(function (data) {
            $('#' + id).remove();
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });

}


function dathang(id) {
    $.ajaxSetup({
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    });
    $.ajax({
        url: 'themgiohang/' + id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
    })
        .done(function (ketqua) {
            console.log(ketqua);

            toastr.success('Đặt hàng thành công ', 'Success Alert', {timeOut: 2000});

            $('.beta-select').html("<i class='fa fa-shopping-cart'></i> Giỏ hàng (" + ketqua.totalQty + ")<i class='fa fa-chevron-down'></i>");
            $.each(ketqua, function (i, item) {
                $('.cart-body').append("<div class='cart-item'><a href='' class='cart-item-edit'><i class='fa fa-pencil'></i></a><button class='cart-item-delete' onclick='XoaItemgiohang(item.id)'><i class='fa fa-pencil'></i></button><div class='media'><a class='pull-left' href=''><img src='' ></a><div class='media-body'><span class=\"cart-item-title\">Sample Woman Top</span>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t<span class=\"cart-item-options\">Size: XS; Colar: Navy</span><span class=\"cart-item-amount\">1*<span>$49.50</span></span</div></div></div>");

            });
            $('.cart-total').html("Tổng tiền:<span class='cart-total-value'>" +ketqua.totalPrice + "</span>");
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });

};

function xemdonhang(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'admin/customer/xemdonhang/' + id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
    })
        .done(function (ketqua) {
            console.log(ketqua);
            $('.t2').remove();
            $.each(ketqua, function (i, item) {
                $('.t1').append("<tr class='t2'><td>" + item.name + "</td><td>" + item.quantity + "</td><td>" + item.unit_price + "</td><td>" + item.note + "</td><td>" + item.date_order + "</td><td>" + item.payment + "</td><td>" + item.quantity * item.unit_price + "</td></tr>");

            });

            $('#modal_show').modal('show');


        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}

function XoaItemgiohang(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'xoagiohang/' + id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
    })
        .done(function (ketqua) {
            toastr.success('Xóa thành công ', 'Success Alert', {timeOut: 2000});
            $('#' + id).remove();

            $('.beta-select').html("<i class='fa fa-shopping-cart'></i> Giỏ hàng (" + ketqua.totalQty + ")<i class='fa fa-chevron-down'></i>");

            $('.cart-total').html("Tổng tiền:<span class='cart-total-value'>" +ketqua.totalPrice + "</span>");
            $('.cart-item:last').append(" <div class='center'> <div class='space10'>&nbsp;</div>  <a href='' class='beta-btn primary text-center'>Đặt hàng <i class='fa fa-chevron-right'></i></a> </div>");




        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}
