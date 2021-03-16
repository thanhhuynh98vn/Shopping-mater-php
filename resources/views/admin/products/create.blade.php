
@extends('templates.admin.master')
@section('content')
<div id="rightSide">
    @include('templates.admin.header')

    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Quản lý  sản phẩm</h5>
            </div>

            <div class="clear"></div>
        </div>
    </div>

    <div class="line"></div>

    <!-- Page statistics and control buttons area -->

    <div class="line"></div>

    <!-- Main content wrapper -->
    <div class="wrapper">

        <!-- Note --> @if (count($errors) > 0)
        <div class="nNote nInformation hideit">
            <p><strong>Thông báo:


                @foreach ($errors->all() as $error)
                <strong style="color: red">{{ $error }}</strong>
                @endforeach


            </strong>

        </p>
    </div>
    @endif

    <!-- Chart -->


    <!-- Widgets -->
    <div class="widgets">
        <div class="oneTwo">

            <!-- Partners list widget -->


        </div>

        <!-- 2 columns widgets -->
        <div class="oneTwo">

            <!-- Search -->

            <div class="clear"></div>

        </div>
        <div class="clear"></div>
    </div>

    <!-- Events calendar -->


    <!-- Media table -->


    <form action="{{route("admin.products.store")}}" class="form" method="post" id="index" enctype="multipart/form-data">
        {{csrf_field()}}
        <fieldset>
            <div class="widget">
                <div class="title"><img src="{{$adminUrl}}/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Thêm sản phẩm</h6></div>
                <div class="formRow">
                    <label>Tên sản phẩm<span class="req">*</span></label>
                    <div class="formRight"> <input name="name" type="text" value="" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Thuộc danh mục:<span class="req">*</span></label>
                    <div class="formRight">
                        <div class="floatL">
                            <select name="producer_id" id="theloai" class="validate[required]" >


                                @foreach($arProducers as $arProducer)
                                <option  value="{{$arProducer->producer_id}}">{{$arProducer->produce_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div><div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Loại sản phẩm:<span class="req">*</span></label>
                    <div class="formRight">
                        <div class="floatL">
                            <select name="id_type" id="loaitinAjax" class="validate[required]" >
                            <option value="">Vui lòng chọn thể loại</option>

                            </select>
                        </div>
                    </div><div class="clear"></div>
                </div>


                <div class="formRow">
                    <label>Đơn giá<span class="req">*</span></label>
                    <div class="formRight"> <input name="unit_price" type="number" value="" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Giảm giá<span class="req">*</span></label>
                    <div class="formRight"> <input name="promotion_price" type="number" value="" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Số lượng<span class="req">*</span></label>
                    <div class="formRight"> <input name="soluong" type="number" value="" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Hình ảnh<span class="req">*</span></label>
                    <div class="formRight"> <input name="picture" type="file" value="" /></div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Mô tả:<span class="req">*</span></label>
                    <div class="formRight">
                        <textarea rows="8" cols="" name="description" class="validate[required]" id="textareaValid"></textarea>
                        <script type="text/javascript" >
                            CKEDITOR.replace( 'textareaValid', {
                                filebrowserBrowseUrl: '{{$adminUrl}}/js/ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl: '{{$adminUrl}}/js/ckfinder/ckfinder.html?type=Images',
                                filebrowserFlashBrowseUrl: '{{$adminUrl}}/js/ckfinder/ckfinder.html?type=Flash',
                                filebrowserUploadUrl: '{{$adminUrl}}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserImageUploadUrl: '{{$adminUrl}}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: '{{$adminUrl}}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                            } );
                        </script>
                    </div><div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Chi tiết:<span class="req">*</span></label>
                    <div class="formRight">
                        <textarea rows="8" cols="" name="detail" id="cks" class="validate[required]"></textarea>
                        <script type="text/javascript" >
                            CKEDITOR.replace( 'cks', {
                                filebrowserBrowseUrl: '{{$adminUrl}}/js/ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl: '{{$adminUrl}}/js/ckfinder/ckfinder.html?type=Images',
                                filebrowserFlashBrowseUrl: '{{$adminUrl}}/js/ckfinder/ckfinder.html?type=Flash',
                                filebrowserUploadUrl: '{{$adminUrl}}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserImageUploadUrl: '{{$adminUrl}}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: '{{$adminUrl}}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                            } );
                        </script>
                    </div><div class="clear"></div>
                </div>
            </div>
            <div class="formSubmit"><input class="blueB ml10" id="next1" value="Reset" type="reset" /></div>
            <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
        </fieldset>
    </form>

        <script>
            $( document ).ready( function () {

                $( "#index" ).validate( {
                    ignore: [],
                    debug: false,
                    rules: {
                        name: {
                            required: true,
                            maxlength: 100,
                        },
                        detail: {
                            required: function(){
                                CKEDITOR.instances.detail.updateElement();
                            },
                            minlength: 5,
                        },
                        unit_price:{
                            required:true,

                        },
                        soluong:{
                            required:true,

                        },
                        picture:{
                            required:true,

                        },
                        detail:{
                            required:true,

                        },
                        description: {
                            required: true,
                            minlength: 5,
                        },

                    },
                    messages: {
                        name: {
                            required: "Vui lòng nhập vào đây",
                            maxlength: "Vui lòng nhập tối đa 100 ký tự",
                        },
                        detail: {
                            required: "Vui lòng nhập vào đây",
                            minlength: "Vui lòng nhập tối thiểu 5 ký tự",
                        },
                        unit_price:{
                            required: "Vui lòng nhập vào đây",

                        },

                        soluong:{
                            required: "Vui lòng nhập vào đây",

                        },
                        picture:{
                            required: "Vui lòng nhập vào đây",

                        },
                        detail:{
                            required: "Vui lòng nhập vào đây",

                        },
                        description: {
                            required: "Vui lòng nhập vào đây",
                            minlength: "Vui lòng nhập tối thiểu 5 ký tự",
                        },
                    },
                });
            });
        </script>
    <!-- Dynamic table -->


</div>

<!-- Footer line -->
@include('templates.admin.footer')

</div>
<script>
    $(document).ready(function (){
        $("#theloai").change(function () {
            var idTheloai=$(this).val();
            $.ajax({
                url: '{{route("admin.ajax.ajax")}}',
                type: 'get',
                dataType: 'json',
                data: {idTheloai: idTheloai},
            })
            .done(function(data) {
                var html = '<option selected value="">Vui lòng chọn thể loại</option>';
                if (data.length > 0) {
                    data.forEach( function(element, valua) {
                     html += '<option value="'+element.id +'">'+element.name+'</option>';
                 });
                }

                $("#loaitinAjax").html(html);
            })
        });
    });
</script>
@stop