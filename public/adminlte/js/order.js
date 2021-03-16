$(document).ready(function () {
    var table_Order= $('#Order').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax": "/admin/bills",
        "columns": [
            {"data": "id_order"},
            {"data": "total"},
            {"data": "created_at"},
            {
                data: "id_order",
                className: "center",
                render: function (data) {
                    return '<a   data-id="' + data + '" class="editor_edit btn btn-primary ShowModalOrder" data-type="View">View</a>  <a href="" class="editor_remove clickDell btn btn-primary" data-id="' + data + '">Delete</a>'
                }
            }
        ]
    });
    $(document).on('click', '.ShowModalOrder', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var url = $("#FormOrder").attr('data-url');
        var _token = $('input[name=_token]').val();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {id:id,_token:_token}
        })
            .done(function(data) {

                if (data.OneOrder) {
                    var OneOrder  = data.OneOrder;
                    var OrderDetail=data.OrderDetail;
                    $('a[name=show]').attr('data-id',OneOrder.id_order);
                    $('input[name=idbill]').val(OneOrder.id_order);
                    $('input[name=users]').val(OneOrder.fullname);
                    $('input[name=name]').val(OrderDetail.name);
                    // OrderDetail.forEach( function(element, valua) {
                    //     $('input[name=name]').val(element.name);
                    //     $('input[name=sl]').val(element.soluong);
                    //     $('input[name=goangia]').val(element.unit_price);
                    // });

                    $('input[name=tongtien]').val(OneOrder.total);


                }


            })
            .fail(function() {
                alert("Không tim thấy id");
            });
        $('#idOrder').val(id);

        $('#myModalOrder').modal('show');

    });
    $(document).on('click','.showdetail',function () {
        $('#classModal').modal('show');
        event.preventDefault();
        var idorders = $(this).attr('data-id');
        var url = $("#FormOrder").attr('data-show');
        var _token = $('input[name=_token]').val();
        var table_detail= $('#classTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "/admin/bills/showdetail",
                type:"get",
                data: function (dt) {
                    dt.idorder = idorders;
                }
            },
            "columns": [
                {"data": "pid"},
                {"data": "name"},
                {"data": "unit_price"},
                {"data": "promotion_price"},
                {"data": "quantity"},
                {"data": "image"}
            ]
        });



    });

    $('#Order').on('click', '.clickDell', function (e) {
        e.preventDefault();
        if (confirm("Bạn có chắc muốm xóa id này không ?")) {
            var $this = $(this);
            var id = $(this).data('id');
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "/admin/bills/dell/"+id,
                type: 'POST',
                dataType: 'json',
                data: {"_token": token, "id": id}
            })
                .done(function (data) {
                    table_Order.ajax.reload();
                }).fail(function () {
                alert('Đã Có Lỗi Xẩy RA VUI Lòng THử Lại');
            })
        }
    });
});
