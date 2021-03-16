
$(document).ready(function () {
	var table_Type= $('#dataType').DataTable({

	"processing": true,
	"serverSide": true,
	"ajax": "/admin/typeproducts",
	"columns": [
	{"data": "id"},
	{"data": "name"},
	{"data": "pname"},
	{
		data: "id",
		className: "center",
		render: function (data) {
			return '<a   data-id="' + data + '" class="editor_edit btn btn-primary ShowModal" data-type="Edit">Edit</a>  <a href="" class="editor_remove clickDelete btn btn-primary" data-id="' + data + '">Delete</a>'
		}
	}
	]
});
$(document).on('click', '.ShowModal', function(event) {
	event.preventDefault();
	var check = $(this).attr('data-type');
	if(check == "Edit"){
		$('.modal-title.titleOK').html("Cập nhật thể loại");
		$('.BTNcreatetype').html("Cập nhật");
		var id = $(this).attr('data-id');
		var url = $("#FormType").attr('data-editUrl');
		var _token = $('input[name=_token]').val();
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {id:id , action:"LoadDataEdit",_token:_token},
		})
		.done(function(data) {
			console.log(data);
			$('#usr').val(data.name);
			$('#idOK').val(data.id);
			$('#producer_id').val(data.producer_id);
		})
		.fail(function() {
			alert("Không tim thấy id cần sửa");
		})

		$('#idOK').val(id);
	}else{
		$('.modal-title.titleOK').html("Thêm thể loại");
		$('.BTNcreatetype').html("Thêm mới");
	}
	$('#myModalType').modal('show');
});
$(document).on('click', '.BTNcreatetype', function(event) {
	event.preventDefault();
	form = $("#FormType");
	var id = $('#idOK').val();
	var url = form.attr('data-url');
	if(id && id.length  > 0){
	    var url = form.attr('data-editUrl');
	}else{
	    var url = form.attr('data-url');
	}
	var data = form.serializeArray();
	$("#FormType").validate({
		rules: {
			name: {
				required: true,
				minlength: 5,
				maxlength: 100
			},
			producer_id: {
				required: true,
			}
		},
            messages: {
            	name: {
            		required:"Vui lòng nhập tên thẻ loại",
            		minlength:"Tên thể loại tối thiệu 5 ký tự."
            	},
            	producer_id: {
            		required: "Vui lòng chọn thể loại cha",

            	}
            }
        });
	if(form.valid()){
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: data,
		})
		.done(function(success) {
			table_Type.ajax.reload();
			$('#myModalType').modal('hide');
			$('#idOK').val('');
		})
		.fail(function() {
			alert("Đã Có Lỗi Xẩy RA");
		})

	}
});

    $('#dataType').on('click', '.clickDelete', function (e) {
        e.preventDefault();
        if (confirm("Bạn có chắc muốm xóa id này không ?")) {
            var $this = $(this);
            var id = $(this).data('id');
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "/admin/typeproducts/del/"+id,
                type: 'POST',
                dataType: 'json',
                data: {"_token": token, "id": id},
            })
                .done(function (data) {
                    table_Type.ajax.reload();
                    // $('.editor_edit[data-id='+id+']').closest('tr').remove();
                }).fail(function () {
                alert('Đã Có Lỗi Xẩy RA VUI Lòng THử Lại');
            })
        }
    });
});
